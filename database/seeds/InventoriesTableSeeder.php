<?php

use Illuminate\Database\Seeder;
use App\Inventory;

class InventoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $inventories = collect([
            ['id' => '1', 'inventory_id' => '1', 'quantity' => '1', 'low' => 1, 'high' => 0],
            ['id' => '2', 'inventory_id' => '2', 'quantity' => '3', 'low' => 1, 'high' => 0],
            ['id' => '3', 'inventory_id' => '3', 'quantity' => '6', 'low' => 1, 'high' => 0],
            ['id' => '4', 'inventory_id' => '4', 'quantity' => '7', 'low' => 1, 'high' => 0],
            ['id' => '5', 'inventory_id' => '5', 'quantity' => '8', 'low' => 1, 'high' => 0],
            ['id' => '6', 'inventory_id' => '6', 'quantity' => '5', 'low' => 1, 'high' => 0],
            ['id' => '7', 'inventory_id' => '7', 'quantity' => '4', 'low' => 1, 'high' => 0],
            ['id' => '8', 'inventory_id' => '8', 'quantity' => '3', 'low' => 1, 'high' => 0],
            ['id' => '9', 'inventory_id' => '9', 'quantity' => '5', 'low' => 1, 'high' => 0],
            ['id' => '10', 'inventory_id' => '10', 'quantity' => '77', 'low' => 0, 'high' => 1],
            ['id' => '11', 'inventory_id' => '11', 'quantity' => '55', 'low' => 0, 'high' => 1],
        ]);

        $inventories->each(function ($inventory) {
            Inventory::create($inventory);
        });
    }
}
