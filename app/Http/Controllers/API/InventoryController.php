<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

use App\Inventory;

class InventoryController extends Controller
{
    public function index()
    {
        return Inventory::all();
    }

    public function show(Inventory $inventory)
    {
        return $inventory;
    }

    public function create()
    {
        return view('inventories.create');
    }

    public function store()
    {
        $attributes = request()->validate([
            'name' => 'required',
            'measurement_id' => 'required',
        ]);

        $inventory = Inventory::create($attributes);
        return response()->json([
            'id' => $inventory->id,
            'message' => 'Inventory was successfully created'
        ]);
    }

    public function update(Inventory $inventory)
    {
        $attributes = request()->validate([
            'name' => 'required',
            'inventory_id' => 'sometimes'
        ]);

        $inventory->update($attributes);

        return response()->json([
            'inventory_item' => $inventory->name,
            'message' => 'inventory updated'
        ]);
    }

    public function destroy(Inventory $inventory)
    {
        $inventory->delete();

        return response()->json([
            'message' => 'inventory was successfully deleted'
        ]);
    }
}
