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
            ['quantity' => '1', 'low' => 1, 'high' => 0],
            ['quantity' => '3', 'low' => 1, 'high' => 0],
            ['quantity' => '6', 'low' => 1, 'high' => 0],
            ['quantity' => '7', 'low' => 1, 'high' => 0],
            ['quantity' => '8', 'low' => 1, 'high' => 0],
            ['quantity' => '5', 'low' => 1, 'high' => 0],
            ['quantity' => '4', 'low' => 1, 'high' => 0],
            ['quantity' => '3', 'low' => 1, 'high' => 0],
            ['quantity' => '5', 'low' => 1, 'high' => 0],
            ['quantity' => '77', 'low' => 0, 'high' => 1],
            ['quantity' => '55', 'low' => 0, 'high' => 1],
        ]);

        $inventories->each(function ($inventory) {
            Inventory::create($inventory);
        });

        factory(Supplier::class, 10)->create()->each(function ($supplier) {
            $ingredient = factory(Ingredient::class)->make();
            $supplier->ingredient()->save($ingredient);
        });
    }
}
