<?php

use Illuminate\Database\Seeder;
use App\Ingredient;

class IngredientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ingredients = collect([
           ['name' => 'salt', 'measurement_id' => 1],
           ['name' => 'pepper', 'measurement_id' => 1],
           ['name' => 'chicken', 'measurement_id' => 1],
           ['name' => 'fish', 'measurement_id' => 1],
           ['name' => 'pork', 'measurement_id' => 1],
           ['name' => 'apple', 'measurement_id' => 1],
           ['name' => 'milk', 'measurement_id' => 1],
           ['name' => 'cheese', 'measurement_id' => 1],
           ['name' => 'egg', 'measurement_id' => 1],
           ['name' => 'bread', 'measurement_id' => 1],
           ['name' => 'orange', 'measurement_id' => 1],
           ['name' => 'carrot', 'measurement_id' => 1],
        ]);

        $ingredients->each(function($ingredient) {
            Ingredient::create($ingredient);
        });
    }
}