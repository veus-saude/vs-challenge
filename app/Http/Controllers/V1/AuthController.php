<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Services\AuthService;
use Illuminate\Http\Request;
use Tymon\JWTAuth\JWTAuth;

class AuthController extends Controller
{
    /**
     * @var JWTAuth
     */
    private $jwt;
    /**
     * @var AuthService
     */
    private $service;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(AuthService $service)
    {
        $this->service = $service;
    }

    public function post(Request $request)
    {
        return response()->json($this->service->login($request->all()));
    }

    public function get()
    {
        return response()->json(new UserResource($this->service->me()));
    }

    public function put()
    {
        return response()->json($this->service->refresh());
    }

    public function delete()
    {
        return response()->json($this->service->logout(),200);
    }
}
