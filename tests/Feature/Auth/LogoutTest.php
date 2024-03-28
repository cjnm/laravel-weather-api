<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;

class LogoutTest extends TestCase
{
    /**
     * Test a user can logout.
     */
    public function test_a_user_can_logout(): void
    {
        $user  = $this->createUser();
        $token = $this->createAccessToken($user);

        $response = $this->delete('/api/logout', [], [ 
            'Accept'        => 'application/json', 
            'Authorization' => 'Bearer ' . $token 
        ]);

        $this->deleteUser($user);

        $response->assertStatus(200);
    }
}
