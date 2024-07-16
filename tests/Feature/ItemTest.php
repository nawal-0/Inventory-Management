<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Item;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ItemTest extends TestCase
{
        use RefreshDatabase;

        protected $seed = true;
        protected $seeder = 'RoleAndPermissionSeeder';


    public function test_user_can_add_items() {
        $user = User::factory()->create();
        $item = Item::factory()->make(['image' => UploadedFile::fake()->image('item.jpg')]);
        
        $response = $this->actingAs($user)->post('/home/add', $item->toArray());
        $item['image'] = "items/".$item['image']->hashname();

        $response->assertRedirect('/home');
        $this->assertDatabaseHas('items', $item->toArray());
    }

    public function test_user_can_edit_items() {
        $user = User::factory()->create();
        $item = Item::factory()->create();
        
        $newData = [
            'description' => 'New Description',
            'quantity' => 1,
        ];

        $updatedItem = array_merge($item->toArray(), $newData);
        $image = UploadedFile::fake()->image('item.jpg');
        $updatedItem['image'] = $image;
      
        $response = $this->actingAs($user)->post("/home/edit/{$item->id}", $updatedItem);
        $updatedItem['image'] = "items/".$image->hashname();
        
        $response->assertRedirect('/home');
        $this->assertDatabaseHas('items', $updatedItem);
    }

    public function test_itemname_validation() {
        $user = User::factory()->create();
        $item = Item::factory()->make(['name' => 'one', 'image' => UploadedFile::fake()->image('item.jpg')]);
        $itemduplicate = Item::factory()->make(['name' => 'one', 'image' => UploadedFile::fake()->image('item.jpg')]);

        $this->actingAs($user)->post('/home/add', $item->toArray());
        $this->actingAs($user)->post('/home/add', $itemduplicate->toArray())->assertSessionHasErrors('name', null, 'new');

        $this->assertDatabaseMissing('items', $itemduplicate->toArray());
       
    }

    public function test_itemimage_validation() {
        $user = User::factory()->create();
        $item = Item::factory()->make(['image' => UploadedFile::fake()->create('document.pdf')]);

        $this->actingAs($user)->post('/home/add', $item->toArray())->assertSessionHasErrors('image', null, 'new');
        $this->assertDatabaseMissing('items', $item->toArray());
    }
    
    public function test_view_items() {
        $user = User::factory()->create();
        $items = Item::factory(2)->create();
        
        $response = $this->actingAs($user)->get('/home');
        $response->assertViewIs('items.index');
        $response->assertSee($items[0]->name);
        $response->assertSee($items[1]->name);
    }

    public function test_search_items() {
        $user = User::factory()->create();
        $items = Item::factory(2)->create();
        $item = Item::factory()->create(['name' => 'xyz'.$items[0]->name]);

        $response = $this->actingAs($user)->get('/home?search='.$items[0]->name);
        $response->assertViewIs('items.index');
        $response->assertSee($items[0]->name);
        $response->assertSee($item->name);
        $response->assertDontSee($items[1]->name);
    }
}
