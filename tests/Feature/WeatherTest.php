<?php

namespace Tests\Feature;

use Tests\TestCase;

class WeatherTest extends TestCase
{
    /**
     * Test weather data returns in valid format.
     */
    public function test_weather_data_returns_in_valid_format(): void
    {
        $user  = $this->createUser();
        $token = $this->createAccessToken($user);

        $lat = '27.712021';
        $lon = '85.312950';

        $response = $this->get('/api/weather?lat=' . $lat . '&lon=' . $lon, [ 
            'Accept'        => 'application/json', 
            'Authorization' => 'Bearer ' . $token 
        ]);

        $this->deleteUser($user);

        $response->assertStatus(200)
        ->assertJsonStructure([
            'id' ,
            'name',
            'cod',
            'dt' ,
            'timezone',
            'coord',
            'weather',
            'base',
            'visibility',
            'wind',
            'clouds',
            'sys'
        ]);
    }

    /**
     * Test if lat is not provided.
     */
    public function test_if_lat_is_not_provided(): void
    {
        $user  = $this->createUser();
        $token = $this->createAccessToken($user);
        $lon   = '85.312950';

        $response = $this->get('/api/weather?&lon=' . $lon, [ 
            'Accept'        => 'application/json', 
            'Authorization' => 'Bearer ' . $token 
        ]);

        $this->deleteUser($user);

        $response->assertStatus(200);
    }
}
