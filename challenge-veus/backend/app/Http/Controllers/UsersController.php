<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\UsersModel;
use Illuminate\Http\Request;

class UsersController extends Controller
{

    public function login(Request $request)
    {
        $user = new UsersModel();
        return $user->login($request);
    }

    public function findAll()
    {
        $result = UsersModel::all();

        return response([
            "status" => (!$result) ? "error" : "success",
            "message" => "",
            "data" => $result
        ]);
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function findByNameOrUsername(Request $request)
    {
        $query = $request->get('q');

        $result = UsersModel::where('users.username', 'like', '%' . $query . '%')
            ->orWhere('users.name', 'like', '%' . $query . '%')
            ->get();

        if (count($result) == 0) {
            return response()->json([
                "status" => (!$result) ? "error" : "success",
                "message" => "No records found",
                "data" => []
            ], 200);
        }

        return response()->json([
            "status" => "success",
            "data" => $result
        ], 200);
    }

    /**
     * @param $id object identifier
     */
    public function findById(int $id)
    {
        $result = response()->json(UsersModel::find($id));

        if (!$result) {
            return response([
                "message" => "User not found",
                "status" => "error",
                "data" => []
            ], 200);
        }

        return response([
            "status" => "succcess",
            "message" => "",
            "data" => $result
        ], 200);
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function create(Request $request)
    {
        $model = new UsersModel();
        return $model->register($request);
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function update(Request $request, int $id)
    {
        $model = new UsersModel();
        return $model->edit($request, $id);
    }
}
