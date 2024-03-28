<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LogoutController extends Controller
{
    /**
     * Handles User Logout
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        $request->user('api')->token()->revoke();

        $message = 'The user has logged out successfully.';

        return response()->json(['status' => 200, 'message' => $message], 200);
    }
}
