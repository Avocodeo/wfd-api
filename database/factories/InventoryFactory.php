<?php

use App\Inventory;
use Faker\Generator as Faker;

$factory->define(Inventory::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'abbreviation' => $faker->randomLetter(),
        'type_id' => $faker->numberBetween(1, 5),
    ];
});
