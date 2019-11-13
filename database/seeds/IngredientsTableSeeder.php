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
            ['name' => 'Salt', 'measurement_id' => 4],
            ['name' => 'Pepper', 'measurement_id' => 4],
            ['name' => 'Chicken', 'measurement_id' => 3],
            ['name' => 'Fish', 'measurement_id' => 3],
            ['name' => 'Pork', 'measurement_id' => 3],
            ['name' => 'Apple', 'measurement_id' => 2],
            ['name' => 'Milk', 'measurement_id' => 5],
            ['name' => 'Cheese', 'measurement_id' => 4],
            ['name' => 'Egg', 'measurement_id' => 1],
            ['name' => 'Bread', 'measurement_id' => 7],
            ['name' => 'Orange', 'measurement_id' => 2],
            ['name' => 'Carrot', 'measurement_id' => 7],
            ['name' => 'Oil', 'measurement_id' => 6],
        ]);

        $ingredients->each(function ($ingredient) {
            Ingredient::create($ingredient);
        });
    }
}
