<?php

namespace App\Http\Controllers\API;

use App\User;
use App\Http\Controllers\Controller;

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
    
     public function destroy(User $user)
    {
        $user->delete();

        return response()->json([
            'message' => 'User was successfully deleted'
        ]);
    }
}
