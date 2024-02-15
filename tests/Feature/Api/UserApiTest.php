<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;

class UserApiTest extends TestCase
{
    // public function test_can_login_user_with_email()
    // {
    //     $userData = [
    //         'email' => 'admin@gmail.com',
    //         'password' => 'Admin123@'
    //     ];
    //     $response = $this->postJson('/api/auth/login', $userData);
    //     $response->assertStatus(200);

    // }


    public function test_user_can_logout()
    {

        $response = $this->post('/api/auth/login', [
            'email' => 'admin@gmail.com',
            'password' => 'Admin123@',
        ]);
        $response = $this->post('/api/auth/logout');
        $this->assertGuest();
        $response->assertStatus(200);
        // dump($response->json());
    }
}
