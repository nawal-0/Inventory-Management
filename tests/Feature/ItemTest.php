<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Item;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ItemTest extends TestCase
{
    public function test_user_can_add_items() {
        $user = User::factory()->create();
        $item = Item::factory()->create();
        
        $response = $this->actingAs($user)
            ->post('/home/add', $item->toArray());

        $this->assertDatabaseHas('items', $item->toArray());
    }


    

}
