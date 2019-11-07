<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Inventory;

class GroceryListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $groceries =
            DB::table('inventories')
                ->select(['ingredients.name', 'inventories.*'])
                ->selectRaw("(low - quantity) as amount")
                ->join('ingredients', 'ingredients.id', '=', 'inventories.ingredient_id')
                ->whereRaw('quantity < low')
                ->get();

        return $groceries;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        foreach($request->purchasedItems as $grocery) {
            $inventoryItem = Inventory::find($grocery['id']);
            $inventoryItem->quantity += $grocery['amount'];
            $inventoryItem->save();
        }

        return response()->json([
            'message' => 'Inventory items from shoppping trip updated'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
