<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateUserApiTest extends TestCase
{
    //use RefreshDatabase;

    public function test_can_create_a_user()
    {
        $userData = [
            'name' => 'Demola Benson',
            'email' => 'demol@bric.com',
            'password' => 'demoL123#',
            'role' => 'admin'
        ];

        $response = $this->post('/api/v1/register', $userData);

        $response->assertStatus(201);

        $this->assertDatabaseHas('users', ['email' => 'demol@bric.com']);
    }


}
