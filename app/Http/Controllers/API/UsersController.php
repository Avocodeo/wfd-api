<?php

namespace App\Http\Controllers\API;

use App\User;
use App\Http\Controllers\Controller;
use App\Events\SystemUpdate;

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
        return view('user.create');
    }

    public function update(User $user)
    {
        $attributes = request()->validate([
            'name' => 'required',
            'email' => 'required',
        ]);

        $user->update($attributes);

        SystemUpdate::dispatch("User Updated!");


        return response()->json([
            'user' => $user->name,
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
