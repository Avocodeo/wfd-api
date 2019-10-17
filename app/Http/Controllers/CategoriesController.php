<?php

namespace App\Http\Controllers;

class CategoriesController extends Controller
{
    public function create()
    {
        return view('categories.create');
    }
}
