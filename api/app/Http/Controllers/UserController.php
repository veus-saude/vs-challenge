<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    private $users;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->users = $user;
    }

    /**
     * @OA\Post(
     *      path="/api/v1/users/auth",
     *      operationId="auth",
     *      tags={"User"},
     *      summary="Get token access",
     *      description="Returns token data",
     *      @OA\Parameter(
     *          name="email",
     *          description="User email",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="password",
     *          description="User password",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="successful operation"
     *       ),
     *     @OA\Response(
     *         response=404,
     *         description="Product not found"
     *     )
     * )
     *
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password', 'username');
        $credentials['email'] = $credentials['email'] ?? $credentials['username'];

        $user = User::where('email', '=', $credentials['email'])->first();

        $response = ['error' => 'Email or password is invalid.'];
        $httpCode = 404;
        if (!empty($user) && Hash::check($credentials['password'], $user->password)) {
            $token =  hash('sha256', Str::random(60));
            $user->forceFill([
                'api_token' => $token,
            ])->save();

            $response = ['token' => $token];
            $httpCode = 200;
        }
        return response()->json($response, $httpCode);
    }

    /**
     * @OA\Post(
     *      path="/api/v1/users",
     *      operationId="auth",
     *      tags={"User"},
     *      summary="Create new User",
     *      description="Create user",
     *      @OA\Parameter(
     *          name="name",
     *          description="User name",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="email",
     *          description="User email",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="password",
     *          description="User password",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="successful operation"
     *       ),
     *     @OA\Response(
     *         response=404,
     *         description="Product not found"
     *     ),
     *     @OA\Response(
     *         response=412,
     *         description="Validation exception"
     *     )
     * )
     *
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $response = $this->users->newUser($request->all());

        $httpCode = $response['return_code'];
        unset($response['return_code']);

        return response()->json($response, $httpCode);
    }
}
