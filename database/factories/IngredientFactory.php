<?php

use App\Ingredient;
use Faker\Generator as Faker;

$factory->define(Ingredient::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'measurement_id' => $faker->numberBetween(1, 5),
    ];
});
