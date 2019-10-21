<?php

use App\Inventory;
use Faker\Generator as Faker;

$factory->define(Inventory::class, function (Faker $faker) {
    return [
        'item_id' => $faker->numberBetween(1, 20),
        'item_quantity' => $faker->randomNumber(1, 30),
        'item_low' => $faker->boolean(),
        'item_high' => $faker->boolean(),
        'item_close_to_expiry' => $faker->boolean(),
    ];
});
