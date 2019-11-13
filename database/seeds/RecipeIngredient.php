<?php

use Illuminate\Database\Seeder;
use App\MeasurementType;

class RecipeIngredient extends Seeder
{
    public function run()
    {
        DB::table('ingredient_recipe')->insert(
            ['recipe_id' => '1', 'ingredient_id' => 1, 'quantity' => 1]
        );
        DB::table('ingredient_recipe')->insert(
            ['recipe_id' => '1', 'ingredient_id' => 2, 'quantity' => 1]
        );
    }
}