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
           ['name' => 'Fried Chicken', 'category_id' => 1],
           ['name' => 'Chicken Soup', 'category_id' => 1],
           ['name' => 'Steak and Fries', 'category_id' => 1],
           ['name' => 'Caesar Salad', 'category_id' => 1],
           ['name' => 'Pumpkin Pie', 'category_id' => 1],
           ['name' => 'Brownies', 'category_id' => 1],
           ['name' => 'Hamburger and Fries', 'category_id' => 1],
           ['name' => 'Sweet and Sour Chicken', 'category_id' => 1],
        ]);

        $recipes->each(function($recipe) {
            Recipe::create($recipe);
        });
    }
}
