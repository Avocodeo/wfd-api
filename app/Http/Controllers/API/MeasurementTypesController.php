<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\MeasurementType;
use App\Events\SystemUpdate;

class MeasurementTypesController extends Controller
{
    public function index()
    {
        return MeasurementType::all();
    }

    public function show(MeasurementType $measurementType)
    {
        return $measurementType;
    }

    public function store()
    {
        $attributes = request()->validate([
            'name' => 'required',
        ]);

        $measurementType = MeasurementType::create($attributes);
        return response()->json([
            'id' => $measurementType->id,
            'message' => 'measurement type was successfully created'
        ]);
    }

    public function update(MeasurementType $measurementType)
    {
        $attributes = request()->validate([
            'name' => 'required',
        ]);

        $measurementType->update($attributes);

        SystemUpdate::dispatch("Measurement Type Updated!");


        return response()->json([
            'measurementType' => $measurementType->name,
            'message' => 'measurement type updated'
        ]);
    }

    public function destroy(MeasurementType $measurementType)
    {
        $measurementType->delete();

        return response()->json([
            'message' => 'measurement type was successfully deleted'
        ]);
    }
}
