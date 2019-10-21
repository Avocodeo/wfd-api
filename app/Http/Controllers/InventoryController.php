<?php

namespace App\Http\Controllers;

class InventoryController extends Controller
{
    public function index()
    {
        return view('inventories.index');
    }

    public function create()
    {
        return view('inventories.create');
    }
}
