<?php

namespace App\Http\Controllers;

class MeasurementsController extends Controller
{
    public function index()
    {
        return view('Measurements.index');
    }

    public function create()
    {
        return view('Measurements.create');
    }
}
