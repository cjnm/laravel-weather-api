<?php
namespace App\Exceptions;

use Exception;

class WeatherException extends Exception
{
    /**
     * Report the exception.
     *
     * @return void
     */
    public function report()
    {
        //
    }

    /**
     * Render the exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function render($request)
    {
        return response([
            'message' => 'Something went wrong while calling the openweather api',
        ], 400);
    }
}