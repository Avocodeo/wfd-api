<?php

namespace App\Http\Controllers\API;

use App\Events\InventoryUpdate;
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
            'ingredient_id' => 'required',
            'quantity' => 'required',
            'low' => 'required',
            'high' => 'required',
        ]);

        $inventory = Inventory::create($attributes);

        return response()->json([
            'id' => $inventory->id,
            'message' => 'Inventory item was successfully created'
        ]);
    }

    public function update(Inventory $inventory)
    {

        $attributes = request()->validate([
            'ingredient_id' => 'sometimes',
            'quantity' => 'sometimes',
            'low' => 'sometimes',
            'high' => 'sometimes'
        ]);

        $inventory->update($attributes);

        InventoryUpdate::dispatch("Inventory Updated!");

        return response()->json([
            'id' => $inventory->id,
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
