<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
//use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['name' => 'add-item']);
        Permission::create(['name' => 'approve-item']);

        $adminRole = Role::create(['name' => 'Admin']);
        $adminRole->givePermissionTo('add-item');
        $adminRole->givePermissionTo('approve-item');

        $userRole = Role::create(['name' => 'User']);
        $userRole->givePermissionTo('add-item');

        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'xxx@gmail.com',
            'password' => bcrypt('password'),
        ]);

        $admin->assignRole('Admin');
    }
}
