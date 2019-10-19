<?php

namespace App\Http\Controllers;

class IngredientsController extends Controller
{
    public function index()
    {
        return view('ingredients.index');
    }

    public function create()
    {
        return view('ingredients.create');
    }
}
