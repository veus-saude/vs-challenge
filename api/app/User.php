<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Support\Facades\Hash;

class User extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    public function validateUser(array $data) : \Illuminate\Validation\Validator
    {
    	$rules = [
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string'
        ];

        return \Validator::make($data, $rules);
    }

    public function newUser(array $data) : array
    {
        $validate = self::validateUser($data);

        if ($validate->fails()){
            $response['messages'] = $validate->messages()->toArray();
            $response['return_code'] = 412;
            return $response;
        }

        $data['password'] = Hash::make($data['password']);

        $this->fill($data);
        $this->save();

        return ['id' => $this->id, 'return_code' => 201];
    }
}
