<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\API\BaseController;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class UserController.
 * 
 * @package App\Http\Controllers\API\v1
 */
class UserController extends BaseController
{
    /**
     * Register API.
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function register(Request $request) : Response
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors(), Response::HTTP_NOT_FOUND);
        }

        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] = $user->createToken('VSChallenge')->accessToken;
        $success['name'] = $user->name;

        return $this->sendResponse($success, 'User register successfully.', Response::HTTP_CREATED);
    }

    /**
     * Login API.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function login(Request $request) : Response
    {
        $authData = [
            'email' => $request->get('email'),
            'password' => $request->get('password')
        ];

        if (Auth::attempt($authData)) {
            $user = Auth::user();
            $success['token'] = $user->createToken('VSChallenge')->accessToken;

            return $this->sendResponse(['success' => $success], 'Logged in.', Response::HTTP_OK);
        }

        return $this->sendError('Unauthorized', [], Response::HTTP_UNAUTHORIZED);
    }
}
