<?php

use Illuminate\Database\Seeder;
use App\Supplier;
use App\Ingredient;

class SuppliersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Supplier::class, 10)->create()->each(function ($supplier) {
            $ingredient = factory(Ingredient::class)->make();
            $supplier->ingredients()->save($ingredient);
        });
    }
}
