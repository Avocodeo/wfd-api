<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Events\SystemUpdate;
use App\Ingredient;

class IngredientsController extends Controller
{
    public function index()
    {
        return Ingredient::all();
    }

    public function show(Ingredient $ingredient)
    {
        return $ingredient;
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

        SystemUpdate::dispatch("Ingredient Created!");

        return response()->json([
            'id' => $ingredient->id,
            'message' => 'ingredient was successfully created'
        ]);
    }

    public function update(Ingredient $ingredient)
    {
        $attributes = request()->validate([
            'name' => 'required',
            'measurement_id' => 'sometimes'
        ]);

        $ingredient->update($attributes);

        SystemUpdate::dispatch("Ingredient Updated!");


        return response()->json([
            'ingredient' => $ingredient->name,
            'message' => 'ingredient updated'
        ]);
    }

    public function destroy(Ingredient $ingredient)
    {
        $ingredient->delete();

        return response()->json([
            'message' => 'ingredient was successfully deleted'
        ]);
    }
}
