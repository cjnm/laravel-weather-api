<?php

return [

    /**
     * Get a free Open Weather Map API key
     * https://openweathermap.org/price.
     *
     */

    'api_key' => env('OPENWEATHER_API_KEY', ""),

    /**
     * Current weather API endpoint : https://api.openweathermap.org/data/2.5/weather.
     * See documentation to get the correct version: https://openweathermap.org/current.
     */
    'weather_api_version' => env('OPENWEATHER_API_VERSION', '2.5'),

    /**
     * Library Configuration
     *
     * https://openweathermap.org/current#multi
     *
     */

    'lang' => env('OPENWEATHER_API_LANG', 'en'),
    'date_format' => 'm/d/Y',
    'time_format' => 'h:i A',
    'day_format' => 'l',

    /**
     * Unit Configuration
     * --------------------------------------
     * Available units are c, f, k. (k is default)
     *
     * For temperature in Fahrenheit (f) and wind speed in miles/hour, use units=imperial
     * For temperature in Celsius (c) and wind speed in meter/sec, use units=metric
     */

    'temp_format' => 'c',
];