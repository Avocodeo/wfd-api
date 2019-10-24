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
            ['id' => '1', 'ingredient_id' => '1', 'quantity' => '1', 'low' => 1, 'high' => 0],
            ['id' => '2', 'ingredient_id' => '2', 'quantity' => '3', 'low' => 1, 'high' => 0],
            ['id' => '3', 'ingredient_id' => '3', 'quantity' => '6', 'low' => 1, 'high' => 0],
            ['id' => '4', 'ingredient_id' => '4', 'quantity' => '7', 'low' => 1, 'high' => 0],
            ['id' => '5', 'ingredient_id' => '5', 'quantity' => '8', 'low' => 1, 'high' => 0],
            ['id' => '6', 'ingredient_id' => '6', 'quantity' => '5', 'low' => 1, 'high' => 0],
            ['id' => '7', 'ingredient_id' => '7', 'quantity' => '4', 'low' => 1, 'high' => 0],
            ['id' => '8', 'ingredient_id' => '8', 'quantity' => '3', 'low' => 1, 'high' => 0],
            ['id' => '9', 'ingredient_id' => '9', 'quantity' => '5', 'low' => 1, 'high' => 0],
            ['id' => '10', 'ingredient_id' => '10', 'quantity' => '77', 'low' => 0, 'high' => 1],
            ['id' => '11', 'ingredient_id' => '11', 'quantity' => '55', 'low' => 0, 'high' => 1],
        ]);

        $inventories->each(function ($inventory) {
            Inventory::create($inventory);
        });
    }
}
