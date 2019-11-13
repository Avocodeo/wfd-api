<?php

namespace App\Http\Controllers;

use App\Recipe;

class RecipeIngredientsController extends Controller
{
    public function show(Recipe $recipe)
    {
        return view('recipe_ingredients.show', compact('recipe'));
    }
}
