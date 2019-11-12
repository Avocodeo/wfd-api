<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Events\SystemUpdate;
use App\Supplier;

class SuppliersController extends Controller
{
    public function index()
    {
        return Supplier::all();
    }

    public function show(Supplier $supplier)
    {
        return $supplier;
    }

    public function create()
    {
        return view('suppliers.create');
    }

    public function store()
    {
        $attributes = request()->validate([
            'name' => 'required',
            'type' => 'required',
        ]);

        $supplier = Supplier::create($attributes);

        SystemUpdate::dispatch("Supplier Created!");

        return response()->json([
            'id' => $supplier->id,
            'message' => 'supplier was successfully created'
        ]);
    }

    public function update(Supplier $supplier)
    {
        $attributes = request()->validate([
            'name' => 'required',
            'type' => 'required',
        ]);

        $supplier->update($attributes);

        SystemUpdate::dispatch("Supplier Updated!");


        return response()->json([
            'supplier' => $supplier->name,
            'message' => 'supplier updated'
        ]);
    }

    public function destroy(Supplier $supplier)
    {
        $supplier->delete();

        return response()->json([
            'message' => 'supplier was successfully deleted'
        ]);
    }
}
