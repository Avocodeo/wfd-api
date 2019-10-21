<?php

use App\Inventory;
use Faker\Generator as Faker;

$factory->define(Inventory::class, function (Faker $faker) {
    return [
        'quantity' => $faker->numberBetween(1, 30),
        'low' => $faker->boolean(),
        'high' => $faker->boolean(),
    ];
});
