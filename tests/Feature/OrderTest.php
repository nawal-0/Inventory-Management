<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Item;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OrderTest extends TestCase
{
    use RefreshDatabase;

    protected $seed = true;
    protected $seeder = 'RoleAndPermissionSeeder';

    public function test_user_can_request_item() {
        $user = User::factory()->create();
        $item = Item::factory()->create();
        
        $response = $this->actingAs($user)->post("/home/order/{$item->id}", ['quantity' => 1]);
        $response->assertRedirect('/home');
        $this->assertDatabaseHas('orders', ['item_id' => $item->id, 'user_id' => $user->id, 'quantity' => 1]);
    }

    public function test_user_can_cancel_order() {
        $user = User::factory()->create();
        $item = Item::factory()->create();
        $order = $user->orders()->create(['item_id' => $item->id, 'quantity' => 1, 'status' => 'pending', 'order_date' => now()]);

        $response = $this->actingAs($user)->get("/home/orders/delete/{$order->id}");
        $this->assertDatabaseMissing('orders', ['id' => $order->id]);
    }

    public function test_user_cannot_approve_order() {
        $user = User::factory()->create();
        $user->assignRole('User');
        $item = Item::factory()->create();
        $order = $user->orders()->create(['item_id' => $item->id, 'quantity' => 15, 'status' => 'pending', 'order_date' => now()]);

        $response = $this->actingAs($user)->get("/home/orders/approve/{$order->id}");
        $response->assertStatus(403);
    }

    public function test_user_cannot_reject_order() {
        $user = User::factory()->create();
        $user->assignRole('User');
        $item = Item::factory()->create();
        $order = $user->orders()->create(['item_id' => $item->id, 'quantity' => 15, 'status' => 'pending', 'order_date' => now()]);

        $response = $this->actingAs($user)->get("/home/orders/reject/{$order->id}");
        $response->assertStatus(403);
    }

    public function test_admin_can_approve_order() {
        $user = User::factory()->create();
        $user->assignRole('Admin');
        $item = Item::factory()->create();
        $order = $user->orders()->create(['item_id' => $item->id, 'quantity' => 15, 'status' => 'pending', 'order_date' => now()]);

        $response = $this->actingAs($user)->get("/home/orders/approve/{$order->id}");
        $this->assertDatabaseHas('orders', ['id' => $order->id, 'status' => 'approved']);
    }

    public function test_admin_can_reject_order() {
        $user = User::factory()->create();
        $user->assignRole('Admin');
        $item = Item::factory()->create();
        $order = $user->orders()->create(['item_id' => $item->id, 'quantity' => 15, 'status' => 'pending', 'order_date' => now()]);

        $response = $this->actingAs($user)->get("/home/orders/reject/{$order->id}");
        $this->assertDatabaseHas('orders', ['id' => $order->id, 'status' => 'rejected']);
    }


}
