<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

use App\Inventory;

class InventoriesController extends Controller
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
            'id' => 'sometimes',
            'quantity' => 'required',
            'low' => 'required',
            'high' => 'required',
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
            'id' => 'sometimes'
        ]);

        $inventory->update($attributes);

        return response()->json([
            'id' => $inventory->item_id,
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
