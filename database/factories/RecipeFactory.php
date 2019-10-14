<?php

use App\Recipe;
use Faker\Generator as Faker;

$factory->define(Recipe::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'category_id' => $faker->numberBetween(1, 5),
    ];
});
