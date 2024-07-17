<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    protected $seed = true;
    protected $seeder = 'RoleAndPermissionSeeder';

    public function test_user_can_register()
    {
        $response = $this->post('/users', [
            'name' => 'John Doe',
            'email' => 'john@gmail.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $response->assertRedirect('/home');
        $response->assertSessionHas('message', 'Logged in successfully');

        $this->assertDatabaseHas('users', [
            'name' => 'John Doe',
            'email' => 'john@gmail.com',
        ]);

    }

    public function test_user_can_login()
    {
        $user = User::factory()->create();
        $response = $this->post('/users/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response->assertRedirect('/home');
        $response->assertSessionHas('message', 'Logged in successfully');
    }

    public function test_register_validation()
    {
        $user = User::factory()->create();
        $response = $this->post('/users', [
            'email' => $user->email,
            'password' => 'pass',
            'password_confirmation' => 'pass',
        ]);

        $response->assertSessionHasErrors(['name', 'email', 'password']);
    }

    public function test_login_invalid_email()
    {
        $response = $this->post('/users/login', [
            'email' => "email@email.com",
            'password' => 'password',
        ]);

        $response->assertSessionHasErrors(['email' => 'Invalid Email or Password. Please try again.']);
    }

    public function test_login_invalid_password()
    {
        $user = User::factory()->create();
        $response = $this->post('/users/login', [
            'email' => $user->email,
            'password' => 'wrongpassword',
        ]);

        $response->assertSessionHasErrors(['email' => 'Invalid Email or Password. Please try again.']);
    }
}
