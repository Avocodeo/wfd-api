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
            'item_id' => 'required',
            'item_quantity' => 'required',
            'item_low' => 'required',
            'item_high' => 'required',
            'item_close_to_expiry' => 'required',
        ]);

        $inventory = Inventory::create($attributes);
        return response()->json([
            'item_id' => $inventory->itemid,
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
            'item_id' => $inventory->item_id,
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
