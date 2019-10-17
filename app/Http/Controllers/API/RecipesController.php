<?php

namespace App\Http\Controllers\API;

use App\Recipe;
use App\Http\Controllers\Controller;

class RecipesController extends Controller
{
    public function index()
    {
        return Recipe::all();
    }

    public function show(Recipe $recipe)
    {
        return $recipe;
    }

    public function create()
    {
        return view('recipes.create');
    }

    public function store()
    {
        $attributes = request()->validate([
            'name' => 'required',
            'category_id' => 'required',
        ]);

        $recipe = Recipe::create($attributes);
        return response()->json([
            'id' => $recipe->id,
            'message' => 'recipe was successfully created'
        ]);
    }

    public function update(Recipe $recipe)
    {
        $attributes = request()->validate([
            'name' => 'required',
        ]);

        $recipe->update($attributes);

        return response()->json([
            'recipe' => $recipe->name,
            'message' => 'recipe updated'
        ]);
    }

    public function destroy(Recipe $recipe)
    {
        $recipe->delete();

        return response()->json([
            'message' => 'recipe was successfully deleted'
        ]);
    }
}
