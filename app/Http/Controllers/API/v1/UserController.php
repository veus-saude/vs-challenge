<?php

namespace App\Http\Controllers\API\v1;

use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $user = Auth::user();
            $data = [
                'data' => $user
            ];
            return response()->json($data, 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'User not found'], 401);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [ 
                'name' => 'required', 
                'email' => 'required|email', 
                'password' => 'required', 
                'confirm_password' => 'required|same:password', 
            ]);
            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()], 401);            
            }
            $param = $request->all();
            $param['password'] = bcrypt($param['password']);
            $user = User::create($param);
            $data = [
                'success' => 'user created',
            ];
            return response()->json($data, 200);
        } catch (\Throwable $th) {
            $data = [
                'error' => 'User not created',
                'userError' => $th->getMessage()
            ];
            return response()->json($data, 401);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
