<?php

use App\Notifications;
use Faker\Generator as Faker;

$factory->define(Notifications::class, function (Faker $faker) {
    return [
        //
        'id' => $faker->unique()->safeEmail,
        'type' => "App\Notifications\LowInventory",
        'notifiable_type' => "App\User",
        'notifiable_id' => $faker->numberBetween(1, 5),
        'data' => "Database has been seeded.",
        'read_at' => now(),
        'created_at' => now(),
        'updated_at' => now(),
    ];
});
