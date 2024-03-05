<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RejectWeakPasswordTest extends TestCase
{
    //use RefreshDatabase;

    public function test_can_reject_weak_password()
    {
        $userData = [
            'name' => 'Amoon Savil',
            'email' => 'savil@userman.com',
            'password' => 'savil',
            'role' => 'user'
        ];

        $response = $this->post('/api/v1/register', $userData);

       // Assert that the response is a redirect because of validation errors
        $response->assertStatus(302);
    }


}
