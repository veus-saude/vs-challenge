<?php

namespace App\Services;

class UserService
{
    public function authorized(array $data)
    {
        $credentials = request([$data['email'], $data['password']]);

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

}
