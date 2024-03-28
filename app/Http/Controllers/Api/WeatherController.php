<?php

namespace App\Http\Controllers\Api;

use App\Clients\WeatherClient;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WeatherController extends Controller
{

    public function __construct() {
        parent::__construct();
    }

    /**
     * Fetches the weather info based on parameter (lng & lon).
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function get(Request $request)
    {

        $lat = $request->get('lat') ?: 0;
        $lon = $request->get('lon') ?: 0;

        $weather = (new WeatherClient)->client()->fetch([
            'lat' => $lat,
            'lon' => $lon
        ]);

        $formattedWeatherData = $this->formatWeatherData($weather);

        return $this->respondWithArray($formattedWeatherData);
    }

    /**
     * Format weather data.
     *
     * @param Object $weather
     *
     * @return Array
     */
    private function formatWeatherData($weather)
    {
        $format     = config('openweather');
        $dateFormat = $format['date_format'] . ' ' . $format['time_format'];

        $weather->sys->sunrise = date($dateFormat, $weather->sys->sunrise);
        $weather->sys->sunset  = date($dateFormat, $weather->sys->sunset);
        $weather->dt           = date($dateFormat, $weather->dt);

        $formattedWeather = [
            'id'         => $weather->id,
            'name'       => $weather->name,
            'cod'        => $weather->cod,
            'dt'         => $weather->dt,
            'timezone'   => $weather->timezone,
            'coord'      => $weather->coord,
            'weather'    => $weather->weather,
            'base'       => $weather->base,
            'visibility' => $weather->visibility,
            'wind'       => $weather->wind,
            'clouds'     => $weather->clouds,
            'sys'        => $weather->sys,
        ];

        return $formattedWeather;
    }
}