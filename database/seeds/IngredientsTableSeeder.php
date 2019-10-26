<?php

use Illuminate\Database\Seeder;
use App\Ingredient;
use App\Supplier;

class IngredientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Ingredient::class, 30)->create();
    }
}
