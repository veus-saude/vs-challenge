<?php


namespace App\Http\Resources\v1\Controllers;

use App\Source\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Laravel\Lumen\Routing\Controller;

class UsersController extends Controller
{
    public function search(Request $request, $id = null)
    {
        $users = User::select([
            'id',
            'name',
            'last_name',
            'email',
            'token'
        ]);

        if($id)
        {
            $users->where('id', $id);
        }

        if($id)
        {
            return response()->json($users->first(), 200);
        }

        return response()->json(
            $users->paginate(15)
                ->appends(Input::except('page')
                ), 200);
    }


    public function create(Request $request)
    {
        $validator = validator($request->input(), [
            'name' => ['required'],
            'last_name' => ['required'],
            'email' => ['required','email','unique:users,email']
        ]);

        if($validator->fails()){
            return response()->json([
                "error" => [
                    "message" => $validator->getMessageBag()->getMessages()
                ]
            ],400);
        }

        $user = new User();
        $user->fill($request->input());

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

        return response()->json([
            'id' => (int)$user->getId(),
            'name' => $user->getName(),
            'last_name' => $user->getLastName(),
            'email' => $user->getEmail(),
            'token' => $user->getToken(),
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $validator = validator(array_merge($request->input(), ['id' => $id]), [
            'id' => ['required', 'exists:users,id'],
            'name' => [],
            'last_name' => [],
            'email' => ['email','unique:users,email,'.$id.',id']
        ]);

        if($validator->fails()){
            return response()->json([
                "error" => [
                    "message" => $validator->getMessageBag()->getMessages()
                ]
            ],400);
        }

        $user = User::find($id);
        $user->fill($request->input());

        if(!empty($user->getChanges())){
            $user->save();
        }

        return response()->json([
            'id' => (int)$user->getId(),
            'name' => $user->getName(),
            'last_name' => $user->getLastName(),
            'email' => $user->getEmail(),
            'token' => $user->getToken(),
        ], 200);
    }

    public function delete(Request $request, $id)
    {
        $validator = validator([
            'id' => $id
        ], [
            'id' => ['required', 'exists:users,id']
        ]);

        if($validator->fails()){
            return response()->json([
                "error" => [
                    "message" => $validator->getMessageBag()->getMessages()
                ]
            ],400);
        }

        if(!User::where('id', $id)->delete()){
            return response()->json([
                "error" => [
                    'message' => 'Ops, algo deu errado, não foi possivel deletar.'
                ]
            ], 400);
        }

        return response()->json([
            "message" => "Deletado com sucesso."
        ], 200);
    }
}