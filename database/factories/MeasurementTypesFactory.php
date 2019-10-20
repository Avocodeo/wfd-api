<?php

use App\MeasurementType;
use Faker\Generator as Faker;

$factory->define(MeasurementType::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
    ];
});
