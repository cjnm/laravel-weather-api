<?php

namespace App\Clients;

use App\Exceptions\InvalidConfiguration;
use App\Exceptions\WeatherException;
use Exception;
use GuzzleHttp\Client;

class WeatherClient
{
    /**
     * Get a free Open Weather Map API key : https://openweathermap.org/price.
     *
     * @var string
     */

    protected $api_key;

    /**
     * base endpoint : https://api.openweathermap.org.
     *
     * @var string
     */
    protected $base_url = 'https://api.openweathermap.org';

    /**
     * Guzzlehttp client
     *
     * @var Client
     */
    protected $service;

    /**
     * Units: available units are c, f, k.
     *
     * For temperature in Fahrenheit (f) and wind speed in miles/hour, use units=imperial
     * For temperature in Celsius (c) and wind speed in meter/sec, use units=metric\
     *
     * @var array
     */
    protected $units = [
        'c' => 'metric',
        'f' => 'imperial',
        'k' => 'standard',
    ];

    /**
     * Open weather config key & values,
     *
     * @var array
     */
    protected $config;

    /**
     * Constructor
     *
     */
    public function __construct()
    {
        self::setConfigParameters();
        self::setApiKey();
    }

    /**
     * Set Api Key.
     *
     */
    protected function setApiKey()
    {
        $this->api_key = $this->config['api_key'];
        if ($this->api_key == '') {
            throw new InvalidConfiguration();
        }
    }

    protected function setConfigParameters()
    {
        $this->config = config('openweather');
    }

    /**
     * build query parameters.
     *
     * @param array $params
     * @return string
     */
    private function buildQueryString(array $params)
    {
        $params['appid'] = $this->api_key;
        $params['units'] = $this->units[$this->config['temp_format']];
        $params['lang'] = $this->config['lang'];

        return http_build_query($params);
    }

    /**
     * Set the guzzlehttp client.
     *
     */
    public function client()
    {
        $this->service = new Client([
            'base_uri' => $this->base_url,
            'timeout' => 10.0,
        ]);

        return $this;
    }

    /**
     * Fetch the weather information.
     * 
     * @param array $params
     * @return object    
     * @throw Exception
     */
    public function fetch($params = [])
    {
        try {
            $params = 'data/' . $this->config['weather_api_version'] . '/weather?' . $this->buildQueryString($params);
            $response = $this->service->request('GET', $params);
            if ($response->getStatusCode() == 200) {
                return json_decode($response->getBody()->getContents());
            }
        } catch (Exception $e) {
            throw new WeatherException($e->getMessage());
        }
    }
}