<?php

namespace Tests\Feature\Auth;

use App\Models\User\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->withHeaders([
            'Origin' => 'localhost',
            'Referer' => 'localhost',
            'Accept' => 'application/json'
        ]);
    }

    public function test_user_can_log_in_with_correct_credentials()
    {
        $password = 'password';

        $user = User::factory()->create([
            'password' => Hash::make($password),
        ]);

        $this->get('/api/xsrf-cookie');

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => $password
        ]);

        $response->assertStatus(200);
        $this->assertAuthenticatedAs($user);
    }

    public function test_user_can_not_log_in_with_incorrect_credentials()
    {
        $password = 'password';

        $user = User::factory()->create([
            'password' => Hash::make($password),
        ]);

        $this->get('/api/xsrf-cookie');

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'an_incorrect_password'
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors('email');
        $this->assertGuest();
    }

}
