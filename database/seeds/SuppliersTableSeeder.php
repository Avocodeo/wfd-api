<?php

use Illuminate\Database\Seeder;
use App\Supplier;

class SuppliersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $suppliers = collect([
            ['name' => 'Pearl Produce', 'type' => 'Produce'],
            ['name' => 'Costco Farms', 'type' => 'General'],
            ['name' => 'Mr. Meats', 'type' => 'Meats'],
            ['name' => 'Dairy Delight', 'type' => 'Dairy'],
            ['name' => 'Marks Cutlery', 'type' => 'Utensils'],
        ]);

        $suppliers->each(function ($supplier) {
            Supplier::create($supplier);
        });
    }
}
