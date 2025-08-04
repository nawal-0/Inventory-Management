<?php

namespace Database\Seeders;

use App\Models\Item;
use App\Models\User;
//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
//use Database\Seeders\RoleAndPermissionSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleAndPermissionSeeder::class,
        ]);
        // User::factory(10)->create();
        // Item::factory(10)->create();

        Item::create([
            'name' => 'Whiteboard Marker',
            'category' => 'Stationery',
            'description' => 'A high-quality whiteboard marker for clear writing.',
            'image' => 'items/whiteboard_marker.jpg',
            'quantity' => 50,
        ]);

        Item::create([
            'name' => 'Laptop',
            'category' => 'Electronics',
            'description' => 'A powerful laptop for all your computing needs.',
            'image' => 'items/laptop.jpg',
            'quantity' => 20,
        ]);

        Item::create([
            'name' => 'Office Chair',
            'category' => 'Furniture',
            'description' => 'An ergonomic office chair for comfortable seating.',
            'image' => 'items/office_chair.jpg',
            'quantity' => 15,
        ]);

        Item::create([
            'name' => 'Projector',
            'category' => 'Electronics',
            'description' => 'A high-definition projector for presentations.',
            'image' => 'items/projector.jpg',
            'quantity' => 10,
        ]);

        Item::create([
            'name' => 'Stapler',
            'category' => 'Stationery',
            'description' => 'A reliable stapler for binding documents together.',
            'image' => 'items/stapler.jpg',
            'quantity' => 100,
        ]);

        Item::create([
            'name' => 'Desk Lamp',
            'category' => 'Lighting',
            'description' => 'A stylish desk lamp for better lighting.',
            'image' => 'items/desk_lamp.jpg',
            'quantity' => 30,
        ]);

        Item::create([
            'name' => 'Whiteboard',
            'category' => 'Furniture',
            'description' => 'A large whiteboard for brainstorming and presentations.',
            'image' => 'items/whiteboard.jpg',
            'quantity' => 5,
        ]);

        Item::create([
            'name' => 'Office Desk',
            'category' => 'Furniture',
            'description' => 'A spacious office desk for work and study.',
            'image' => 'items/office_desk.jpg',
            'quantity' => 8,
        ]);

        Item::create([
            'name' => 'Printer',
            'category' => 'Electronics',
            'description' => 'A multifunctional printer for printing, scanning, and copying.',
            'image' => 'items/printer.jpeg',
            'quantity' => 12,
        ]);

        Item::create([
            'name' => 'File Cabinet',
            'category' => 'Furniture',
            'description' => 'A secure file cabinet for storing important documents.',
            'image' => 'items/file_cabinet.jpg',
            'quantity' => 6,
        ]);

        

    }

}
