<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Validator;

class AdminUserController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = User::query();
        if ($request->has('q')) {
            $query->where('name', 'like', '%' . $request->get('q') . '%')
                ->orWhere('brand', 'like', '%' . $request->get('q') . '%');
        }
        if ($request->has('filter')) {
            $query->Where('brand', $request->get('filter'));
        }

        $users = $query->paginate();
        return view('admin.users.index', compact("users"));
    }


    public function create()
    {
        return view('admin.users.create');
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:55',
            'email' => 'email|required|unique:users',
            'password' => 'required|confirmed'
        ]);

        $validatedData['password'] = bcrypt($request->password);

        $user = User::create($validatedData);

        $accessToken = $user->createToken('authToken')->accessToken;

        return redirect('/admin/users')->with('success', 'Success creating user.');
    }


    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }


    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }


    public function update(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:55',
            'email' => 'email|required',
            'password' => 'confirmed'
        ]);
        if (empty($validatedData['password'])) {
            unset($validatedData['password']);
            unset($validatedData['password_confirmation']);
        } else {
            $validatedData['password'] = bcrypt($request->password);

        }
        $validatedData['status'] = $request->status;
        $user->update($validatedData);

        $accessToken = $user->createToken('authToken')->accessToken;

        return redirect('/admin/users')->with('success', 'User edit success.');
    }


    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', 'User deleted success');
    }
    public function restore(User $user)
    {
        // Restaura:
        $user->restore();
        return redirect()->route('admin.users.index')
            ->with('success', 'User restore sucess');
    }

    public function onlyTrashed()
    {
        $usersTrashed = User::onlyTrashed()->get();
        return view('admin.users.trashed', compact('usersTrashed'));
    }

    public function forceDelete(User $user)
    {

        // Deleta definitivamente:
        $user->forceDelete();
        return redirect()->route('admin.users.index')
            ->with('success', 'User definetly deleted');
    }
}
