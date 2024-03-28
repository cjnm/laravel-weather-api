<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    /**
     * User can register.
     */
    public function test_user_can_register(): void
    {
        $response = $this->post('/api/register', [
            'name'                  => "Test User",
            'email'                 => 'test@email.com',
            'password'              => 'secret123',
            'password_confirmation' => 'secret123',
        ], [
            'Accept'       => 'application/json', 
            'Content-Type' => 'application/x-www-form-urlencoded'
        ]);

        $user = User::where('email', 'test@email.com')->delete();

        $response->assertStatus(201);

    }

    /**
     * User can not register with existing email.
     */
    public function test_user_can_not_register_with_existing_email(): void
    {
        $user = User::first();

        $response = $this->post('/api/register', [
            'name'                  => "Test User",
            'email'                 => $user->email,
            'password'              => 'secret123',
            'password_confirmation' => 'secret123',
        ], [
            'Accept'       => 'application/json', 
            'Content-Type' => 'application/x-www-form-urlencoded'
        ]);

        $response->assertStatus(400);

    }
}
