<?php

namespace App\Http\Controllers;

class MeasurementsController extends Controller
{
    public function index()
    {
        return view('measurements.index');
    }

    public function create()
    {
        return view('measurements.create');
    }
}
