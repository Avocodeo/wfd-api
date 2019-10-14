<?php

use App\Measurement;
use Faker\Generator as Faker;

$factory->define(Measurement::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'abbreviation' => $faker->randomLetter(),
        'type_id' => $faker->numberBetween(1, 5),
    ];
});
