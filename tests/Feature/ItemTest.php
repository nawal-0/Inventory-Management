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
    public function test_user_can_add_items() {
        $user = User::factory()->create();
        $item = Item::factory()->make();

        $image = UploadedFile::fake()->image('item.jpg');
        $item['image'] = $image;
        
        $response = $this->actingAs($user)->post('/home/add', $item->toArray());
        $item['image'] = "items/".$image->hashname();

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
    

}
