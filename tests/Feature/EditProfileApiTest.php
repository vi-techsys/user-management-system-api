<?php
// tests/Feature/UserApiTest.php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class EditProfileApiTest extends TestCase
{
    //use RefreshDatabase;

    public function test_can_edit_profile()
    {
        $email ='myoldname@userman.com';
        $user = User::factory()->create([
            'name' => 'My Old Username',
            'email' => $email,
            'password' => Hash::make('password123@'),
        ]);

        $newName = 'Current Username';

        $token = $user->createToken('user-token')->accessToken;

        $response = $this->withHeaders(['Authorization' => "Bearer $token"])
            ->put('/api/v1/edit-profile', ['name' => $newName]);

        $response->assertStatus(200);

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => $newName,
            'email' => $email,
        ]);
    }
}
