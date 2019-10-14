<?php

use Illuminate\Database\Seeder;
use App\Recipe;

class RecipesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $recipes = collect([
           ['name' => 'Fried Chicken'],
           ['name' => 'Chicken Soup'],
           ['name' => 'Steak and Fries'],
           ['name' => 'Caesar Salad'],
           ['name' => 'Pumpkin Pie'],
           ['name' => 'Brownies'],
           ['name' => 'Hamburger and Fries'],
           ['name' => 'Sweet and Sour Chicken'],
        ]);

        $recipes->each(function($recipe) {
            Recipe::create($recipe);
        });
    }
}
