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
        return view('user.create');
    }

    //     public function store()
    //     {
    //         $attributes = request()->validate([
    //             'name' => 'required',
    //             'measurement_id' => 'required',
    //         ]);

    //         $ingredient = Ingredient::create($attributes);
    //         return response()->json([
    //             'id' => $ingredient->id,
    //             'message' => 'ingredient was successfully created'
    //         ]);
    //     }

    //     public function update(Ingredient $ingredient)
    //     {
    //         $attributes = request()->validate([
    //             'name' => 'required',
    //         ]);

    //         $ingredient->update($attributes);

    //         return response()->json([
    //             'ingredient' => $ingredient->name,
    //             'message' => 'ingredient updated'
    //         ]);
    //     }

    //     public function destroy(Ingredient $ingredient)
    //     {
    //         $ingredient->delete();

    //         return response()->json([
    //             'message' => 'ingredient was successfully deleted'
    //         ]);
    //     }
}
