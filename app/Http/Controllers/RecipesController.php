<?php

namespace App\Http\Controllers;

class RecipesController extends Controller
{
    public function create()
    {
        return view('recipes.create');
    }
}
