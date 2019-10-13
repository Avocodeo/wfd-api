<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategoriesTableSeeder extends Seeder
{
    public function run()
    {
        $categories = collect([
            ['name' =>'Breakfast'],
            ['name' =>'Lunch'],
            ['name' =>'Dinner'],
            ['name' =>'Desert'],
            ['name' =>'Snack'],
        ]);

        $categories->each(function($category) {
           Category::create($category);
        });
    }
}
