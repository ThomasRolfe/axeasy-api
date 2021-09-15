<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function setUp(): void
    {
        parent::setUp();

        $this->withHeaders([
            'Origin' => 'localhost',
            'Referer' => 'localhost',
            'Accept' => 'application/json'
        ]);
    }

    public function test_user_can_register()
    {
        $this->get('/api/xsrf-cookie');

        $name = $this->faker->name;
        $email = $this->faker->email;
        $password = 'password';

        $response = $this->post('/register', [
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'password_confirmation' => $password
        ]);

        $response->assertStatus(201);

        $this->assertDatabaseHas('Users', [
            'email' => $email,
            'name' => $name
        ]);
    }

    public function test_user_cannot_register_with_wrong_password_confirmation()
    {
        $this->get('/api/xsrf-cookie');

        $name = $this->faker->name;
        $email = $this->faker->email;
        $password = 'password';

        $response = $this->post('/register', [
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'password_confirmation' => 'wrong password'
        ]);

        $response->assertStatus(422);

        $this->assertDatabaseMissing('users', [
            'email' => $email,
            'name' => $name,
            'email_verified_at' => null
        ]);
    }
}
