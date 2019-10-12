<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\User;

class UsersController extends Controller
{
    public function index()
    {
        return User::all();
    }

    public function show(User $user)
    {
        return $user;
    }

    public function create()
    {
        return view('users.create');
    }

    public function store()
    {
        $attributes = request()->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        $user = User::create($attributes);
        return response()->json([
            'name' => $user->name,
            'email' => $user->email,
            'password' => $user->password,
            'message' => 'user was successfully created'
        ]);
    }

    public function update(User $user)
    {
        $attributes = request()->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        $user->update($attributes);

        return response()->json([
            'name' => $user->name,
            'message' => 'user updated'
        ]);
    }

    public function destroy(User $user)
    {
        $user->delete();

        return response()->json([
            'message' => 'User was successfully deleted'
        ]);
    }
}
