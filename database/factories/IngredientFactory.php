<?php

use App\Ingredient;
use App\Supplier;
use Faker\Generator as Faker;

$factory->define(Ingredient::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'cost' => $faker->numberBetween(0, 10),
        'supplier_id' => factory(Supplier::class)->create()->id,
    ];
});
