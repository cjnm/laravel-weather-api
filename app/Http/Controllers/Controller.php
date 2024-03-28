<?php

namespace App\Http\Controllers;

use App\HAL\HydratorManager;
use App\Traits\ResponseTrait;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    use ResponseTrait;

    /**
     * Constructor
     *
     * @param Manager|null $hydrator
     */
    public function __construct(HydratorManager $hydrator = null)
    {
        $hydrator = $hydrator === null ? new HydratorManager() : $hydrator;
        $this->setHydrator($hydrator);
    }

    /**
     * Validate HTTP request against the rules
     *
     * @param Request $request
     * @param array $rules
     *
     * @return bool|array
     */
    protected function validateRequest(Request $request, array $rules)
    {
        // Perform Validation
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $errorMessages = $validator->errors()->messages();

            // crete error message by using key and value
            foreach ($errorMessages as $key => $value) {
                $errorMessages[$key] = $value[0];
            }

            return $errorMessages;
        }

        return true;
    }

    /**
     * Get current user details
     *
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    protected function getCurrentUserDetails()
    {
        $currentUser = Auth::user();

        return $currentUser;
    }
}
