<?php
// tests/Feature/UserApiTest.php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class FailLoginTest extends TestCase
{
   // use RefreshDatabase;

    public function test_fail_login_with_incorrect_credentials()
    {
        $invalidLoginData = [
            'email' => 'test@userman.com',
            'password' => 'wrongpassworD@1',
        ];

        $response = $this->post('/api/v1/login', $invalidLoginData);

        $response->assertStatus(401);
    }
}
