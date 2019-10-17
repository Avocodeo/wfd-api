<?php

namespace App\Http\Controllers\API;

use Illuminate\Foundation\Auth\User;
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
}
