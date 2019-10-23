<?php

namespace App\Http\Controllers;

class SuppliersController extends Controller
{
    public function index()
    {
        return view('suppliers.index');
    }

    public function create()
    {
        return view('suppliers.create');
    }
}
