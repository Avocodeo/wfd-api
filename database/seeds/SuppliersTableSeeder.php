<?php

use Illuminate\Database\Seeder;

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
            ['name' => 'Pearl Produce'],
            ['name' => 'Costco Farms'],
            ['name' => 'Mr. Meats'],
            ['name' => 'Dairy Delight'],
            ['name' => 'Marks Cutlery'],
        ]);

        $suppliers->each(function ($supplier) {
            Supplier::create($supplier);
        });
    }
}
