<?php

use App\Measurement;
use App\MeasurementType;
use Faker\Generator as Faker;

$factory->define(Measurement::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'abbreviation' => $faker->randomLetter(),
        'type_id' => factory(MeasurementType::class)->create()->id,
    ];
});
