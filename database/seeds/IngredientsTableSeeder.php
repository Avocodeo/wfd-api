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
        $ingredients = collect([
            ['name' => 'salt',    'cost' => 0.1,],
            ['name' => 'pepper',  'cost' => 0.2,],
            ['name' => 'chicken', 'cost' => 3,],
            ['name' => 'fish',    'cost' => 4,],
            ['name' => 'pork',    'cost' => 4,],
            ['name' => 'apple',   'cost' => .6,],
            ['name' => 'milk',    'cost' => 3,],
            ['name' => 'cheese',  'cost' => 5,],
            ['name' => 'egg',     'cost' => 0.2,],
            ['name' => 'bread',   'cost' => 2,],
            ['name' => 'orange',  'cost' => .4,],
            ['name' => 'carrot',  'cost' => 0.5,],
        ]);

        $ingredients->each(function ($ingredient) {
            Ingredient::create($ingredient);
        });
    }
}
