<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     * Create a database user
     */
    public function createUser()
    {
        return User::factory()->create();
    }

    /**
     * Create a access user
     * 
     * @param User $user
     * 
     */
    public function createAccessToken($user) 
    {
        return $user->createToken('api')->accessToken;
    }

    /**
     * Create a access user
     * 
     * @param User $user
     * 
     */
    public function deleteUser($user) 
    {
        $user->delete();
    }
}
