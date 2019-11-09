<?php

namespace App\Http\Controllers;
use Illuminate\Notifications\Notifiable;

class UsersController extends Controller
{

    public function create()
    {
        return view('users.create');
    }

    public function index()
    {
        return view('users.index');
    }
}
