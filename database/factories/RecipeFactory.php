<?php

use App\Category;
use App\Recipe;
use Faker\Generator as Faker;

$factory->define(Recipe::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'category_id' => factory(Category::class)->create()->id,
    ];
});
