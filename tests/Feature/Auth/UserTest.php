<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * Can get user list.
     */
    public function test_can_get_user_list(): void
    {
        $user  = $this->createUser();
        $token = $this->createAccessToken($user);

        $response = $this->get('/api/users', [ 
            'Accept'        => 'application/json', 
            'Authorization' => 'Bearer ' . $token 
        ]);

        $response->assertStatus(200);
    }

    /**
     * Can get user by id.
     */
    public function test_can_get_user_by_id(): void
    {
        $user  = $this->createUser();
        $token = $this->createAccessToken($user);

        $response = $this->get('/api/users/25', [ 
            'Accept'        => 'application/json', 
            'Authorization' => 'Bearer ' . $token 
        ]);

        $response->assertStatus(200);
    }

    /**
     * Can get current user.
     */
    public function test_can_get_current_user(): void
    {
        $user  = $this->createUser();
        $token = $this->createAccessToken($user);

        $response = $this->get('/api/users/current', [ 
            'Accept'        => 'application/json', 
            'Authorization' => 'Bearer ' . $token 
        ]);

        $response->assertStatus(200);
    }
}
