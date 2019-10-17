<?php

namespace App\Http\Controllers;

class MeasurementsController extends Controller
{
    public function create()
    {
        return view('measurements.create');
    }
}
