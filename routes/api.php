<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::group(['middleware' => 'throttle:60,1', 'namespace' => 'App\Http\Controllers\Api'], function () {
    //  Register Routes...
    Route::post('register', 'Auth\RegisterController@register');

    //  Login Routes...
    Route::post('login', 'Auth\LoginController@login');

});

Route::group(['middleware' => 'auth:api', 'namespace' => 'App\Http\Controllers\Api'], function () {
    //  User Routes...
    Route::get('users', 'UserController@index');
    Route::get('users/me', 'UserController@getCurrentUser');
    Route::get('users/{id}', 'UserController@show')->name('user.show');

    //  Logout Routes...
    Route::delete('logout', 'Auth\LogoutController@logout');

    //  Weather routes
    Route::get('weather', 'WeatherController@get');
});
