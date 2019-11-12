<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Measurement;
use App\Events\SystemUpdate;

class MeasurementsController extends Controller
{
    public function index()
    {
        return Measurement::all();
    }

    public function show(Measurement $measurement)
    {
        return $measurement;
    }

    public function create()
    {
        return view('measurements.create');
    }

    public function store()
    {
        $attributes = request()->validate([
            'name' => 'required',
            'abbreviation' => 'required',
            'type_id' => 'sometimes'
        ]);

        $measurement = Measurement::create($attributes);

        SystemUpdate::dispatch("Measurement Created!");

        return response()->json([
            'id' => $measurement->id,
            'message' => 'measurement was successfully created'
        ]);
    }

    public function update(Measurement $measurement)
    {
        $attributes = request()->validate([
            'name' => 'required',
            'abbreviation' => 'required',
            'type_id' => 'sometimes'
        ]);

        $measurement->update($attributes);

        SystemUpdate::dispatch("Measurement Updated!");


        return response()->json([
            'measurement' => $measurement->name,
            'message' => 'measurement updated'
        ]);
    }

    public function destroy(Measurement $measurement)
    {
        $measurement->delete();

        return response()->json([
            'message' => 'measurement was successfully deleted'
        ]);
    }
}
