<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;

class LoginTest extends TestCase
{    

    protected $client_id     = '2';
    protected $client_secret = 'OVIwyG0UsRE7sVsIyZZz0dqep1012FM1FwOliUwA';

    /**
     * Test a user can login with username and password
     */
    public function test_a_user_can_login_with_username_and_password(): void
    {

        $user = $this->createUser();

        $response = $this->post('/api/login', [
            'grant_type'    => 'password',
            'client_id'     => $this->client_id,
            'client_secret' => $this->client_secret,
            'username'      => $user->email,
            'password'      => 'password'
        ], [
            'Accept'       => 'application/json', 
            'Content-Type' => 'application/x-www-form-urlencoded'
        ]);

        $this->deleteUser($user);

        $response->assertStatus(200)
        ->assertJsonStructure([
            'token_type',
            'expires_in',
            'access_token',
            'refresh_token'
        ]);
    }

    /**
     * Test a user can login with username and password
     */
    public function test_a_user_can_not_login_with_wrong_client_id(): void
    {
        $user  = $this->createUser();

        $response = $this->post('/api/login', [
            'grant_type'    => 'password',
            'client_id'     => '1',
            'client_secret' => $this->client_secret,
            'username'      => $user->email,
            'password'      => 'password'
        ], [
            'Accept'       => 'application/json', 
            'Content-Type' => 'application/x-www-form-urlencoded'
        ]);

        $this->deleteUser($user);

        $response->assertStatus(401);
    }

    /**
     * Test a user can not login with wrong password
     */
    public function test_a_user_can_not_login_with_wrong_password(): void
    {
        $user  = $this->createUser();

        $response = $this->post('/api/login', [
            'grant_type'    => 'password',
            'client_id'     => $this->client_id,
            'client_secret' => $this->client_secret,
            'username'      => $user->email,
            'password'      => 'password2'
        ], [
            'Accept'       => 'application/json', 
            'Content-Type' => 'application/x-www-form-urlencoded'
        ]);

        $this->deleteUser($user);

        $response->assertStatus(400);
    }
}
