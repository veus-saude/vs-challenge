<?php

namespace Model\User;
use Hash;

class UserRepository implements UserRepositoryInterface
{
    public function create($user_data)
    {
        $user = new User();
        $user->name = $user_data['name'];
        $user->email = $user_data['email'];
        $user->password = Hash::make($user_data['password']);
        $user->save();
        return $user;
    }
}
