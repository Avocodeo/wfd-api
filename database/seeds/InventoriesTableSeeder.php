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
        $inventory = collect([
            ['name' => 'salt', 'item_id' => 1],
            ['name' => 'pepper', 'item_id' => 2],
            ['name' => 'chicken', 'item_id' => 3],
            ['name' => 'fish', 'item_id' => 4],
            ['name' => 'pork', 'item_id' => 5],
            ['name' => 'apple', 'item_id' => 6],
            ['name' => 'milk', 'item_id' => 7],
            ['name' => 'cheese', 'item_id' => 8],
            ['name' => 'egg', 'item_id' => 9],
            ['name' => 'bread', 'item_id' => 10],
            ['name' => 'orange', 'item_id' => 11],
            ['name' => 'carrot', 'item_id' => 12],
        ]);

        $inventory->each(function ($inventory) {
            Inventory::create($inventory);
        });
    }
}
