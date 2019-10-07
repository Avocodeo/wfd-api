<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ingredient;

class IngredientsController extends Controller
{
    public function index()
    {

    }

    public function show()
    {

    }

    public function create()
    {
        return view('ingredients.create');
    }

    public function store()
    {
        $attributes = request()->validate([
            'name' => 'required',
            'measurement_id' => 'required',
        ]);

        $ingredient = Ingredient::create($attributes);
        return response()->json([
            'id' => $ingredient->id,
            'message' => 'ingredient was successfully created'
        ]);
    }

    public function update()
    {

    }

    public function destroy()
    {

    }
}
