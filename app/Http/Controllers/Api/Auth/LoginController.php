<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /**
     * Handles User Logout
     *
     * We can restrict the scope based on user roles
     * 
     * @param Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {

        $inputs = $request->all();

        if ( ! $request->has('scope')) {
            $request->request->add(['scope' => '*']);
        }

        $tokenRequest = $request->create('/oauth/token', 'post', $request->all());

        // forward the request to the oauth token request endpoint
        return \Route::dispatch($tokenRequest);
    }
}
