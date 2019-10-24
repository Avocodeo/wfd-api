<?php

use App\Ingredient;
use App\Inventory;
use Faker\Generator as Faker;

$factory->define(Inventory::class, function (Faker $faker) {
    return [
        'ingredient_id' => factory(Ingredient::class)->create()->id,
        'quantity' => $faker->numberBetween(1, 30),
        'low' => $faker->numberBetween(1,10),
        'high' => $faker->numberBetween(1,10),
    ];
});
