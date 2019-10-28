<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Common\AbstractModel;
use App\Common\Authenticator;
use App\Common\Json;
use App\Config\Configuration as cfg;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UsersModel extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'username', 'password'
    ];

    /**
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function register(Request $request)
    {
        $data = (object) $request->all();

        if (!AbstractModel::inputValidate($data, 'users_schema.json')) {
            return response([
                "message" => "There are wrong fields in submission",
                "status" => "error",
                "error" => Json::getValidateErrors()
            ], 400);
        }

        $duplicate = self::notDuplicate($data);
        if ($duplicate) {
            return $duplicate;
        }

        try {
            $datas = [
                "name" => $data->name,
                "email" => $data->email,
                "username" => md5($data->username),
                "password" => password_hash($data->password . cfg::SALT_KEY, PASSWORD_DEFAULT),
            ];

            $result = self::create($datas);

            return response([
                "message" => "Registry created successfully",
                "status" => "success",
                "data" => $result
            ], 201);
        } catch (\Exception $ex) {
            return response([
                "message" => $ex->getMessage(),
                "status" => "error"
            ], 400);
        }
    }

    /**
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function edit(Request $request, $id)
    {
        $data = (object) $request->all();

        if (!AbstractModel::inputValidate($data, 'users_schema.json')) {
            return response([
                "message" => "There are wrong fields in submission",
                "status" => "error",
                "error" => Json::getValidateErrors()
            ], 400);
        }

        try {
            $user = self::find($id);

            if (!$user) {
                return response([
                    "message" => "User not found",
                    "status" => "error",
                    "data" => []
                ], 200);
            }

            $user->name = $data->name;
            $user->email = $data->brand;
            $user->username = md5($data->username);
            $user->password = password_hash($data->password . cfg::SALT_KEY, PASSWORD_DEFAULT);

            $user->save();

            return response([
                "message" => "Registry updated successfully",
                "status" => "success",
                "data" => $user
            ], 200);
        } catch (\Exception $ex) {
            return response([
                "message" => $ex->getMessage(),
                "status" => "error"
            ], 400);
        }
    }

    public function login(Request $request)
    {
        $data = (object) $request->all() ?: [];

        try {
            $entity = $this->where('username', md5($data->username))->first();

            if (
                !$entity ||
                !password_verify($data->password . cfg::SALT_KEY, $entity->password) ||
                !$entity->active == 'ENABLE'
            ) {
                return response([
                    "message" => "Invalid User",
                    "status" => "error",
                    "data" => []
                ], 401);
            }

            $userData = [
                'expiration_sec' => cfg::EXPIRATE_TOKEN,
                'host' => cfg::HOST_DEV,
                'userdata' => [
                    "id" => $entity->id,
                    "name" => $entity->name
                ]
            ];

            return response([
                "message" => "User Authorized",
                "status" => "success",
                "data" => [
                    "userId" => $entity->id,
                    "userName" => $entity->name,
                    "token" => Authenticator::generateToken($userData)
                ]
            ], 200);
        } catch (\Exception $ex) {
            return response([
                "message" => $ex->getMessage(),
                "status" => "error",
                "data" => ""
            ], 500);
        }
    }

    private static function notDuplicate($data)
    {
        $result = self::where('email', $data->email)->first();
        if ($result) {
            return response([
                "message" => "The reported email has already been registered",
                "status" => "error"
            ], 200);
        }

        $result = self::where('username', md5($data->username))->first();
        if ($result) {
            return response([
                "message" => "The reported username has already been registered",
                "status" => "error"
            ], 200);
        }
    }
}
