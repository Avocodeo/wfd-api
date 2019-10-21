<?php

namespace App\Http\Controllers;

class InventoryController extends Controller
{
    public function index()
    {
        return view('inventory.index');
    }

    public function create()
    {
        return view('inventory.create');
    }
}
