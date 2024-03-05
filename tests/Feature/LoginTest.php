<?php
// tests/Feature/UserApiTest.php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
class LoginTest extends TestCase
{
    //use RefreshDatabase;

    public function test_can_login_a_user()
    {
        $email ='paultnd@userman.com';
        $password ='password123@';
        $user = User::factory()->create([
            'email' => $email,
            'password' => Hash::make($password),
        ]);

        $loginData = [
            'email' => $email,
            'password' => $password,
        ];

        $response = $this->post('/api/v1/login', $loginData);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data',
                'message'
            ]);
    }
}
