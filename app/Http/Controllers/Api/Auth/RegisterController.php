<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{

    public function __construct() {
        parent::__construct();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function register(Request $request)
    {

        // Validation
        $validatorResponse = $this->validateRequest($request, $this->registerRequestValidationRules($request));

        if ($validatorResponse !== true) {
            return $this->sendInvalidFieldResponse($validatorResponse);
        }

        $request->request->add(['email_verified_at' => now()]);

        $user = User::create($request->all());

        if ( ! $user instanceof User) {
            return $this->sendCustomResponse(500, 'Error occurred on creating User');
        }

        return $this->setStatusCode(201)->respondWithItem($user);
    }

    /**
     * Register Request Validation Rules
     *
     *
     * @return array
     */
    private function registerRequestValidationRules()
    {
        $rules = [
            'name'     => 'required|max:100',
            'email'    => 'email|unique:users,email',
            'password' => 'required|min:8|confirmed'
        ];

        return $rules;
    }
}
