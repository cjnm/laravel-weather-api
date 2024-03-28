<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function __construct() {
        parent::__construct();
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     *
     * @return mixed
     */
    public function index(Request $request)
    {
        $users = User::all();

        return $this->respondWithCollection($users);
    }

    /**
     * Display the specified resource.
     *
     * @param integer
     *
     * @return \Illuminate\Http\JsonResponse|string
     */
    public function show($id)
    {
        $user = User::find($id);

        if ( ! $user instanceof User) {
            return $this->sendNotFoundResponse("The user with id: {$id} doesn't exist");
        }

        return $this->respondWithItem($user);
    }

    /**
     * Get details of current user.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCurrentUser()
    {
        $currentUser = $this->getCurrentUserDetails();

        return $this->respondWithItem($currentUser);
    }
}
