<?php

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Source\User::class, 5)->create()->each(function (\App\Source\User $user) {
            $tokenInfo = [
                "iss" => config('jwt.JWT_ISS'),
                "sub" => config('jwt.JWT_SUB'),
                "aud" => config('jwt.JWT_AUD'),
                "data" => [
                    "id" => $user->getId(),
                    "name" => $user->getName(),
                    "last_name" => $user->getLastName(),
                    "email" => $user->getEmail()
                ]
            ];

            $user->setToken(\Firebase\JWT\JWT::encode($tokenInfo, config('jwt.secret')));
            $user->save();
        });
    }
}
