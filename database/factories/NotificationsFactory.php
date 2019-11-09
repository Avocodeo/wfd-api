<?php

use App\Notifications;
use App\User;
use Faker\Generator as Faker;

$factory->define(Notifications::class, function (Faker $faker) {
    return [
        //
        'id' => $faker->numberBetween(0, 100),
        'type' => "App\Notifications\LowInventory",
        'notifiable_type' => "App\User",
        'notifiable_id' => factory(User::class)->create()->id,
        'data' => "Database has been seeded.",
        'read_at' => now(),
        'created_at' => now(),
        'updated_at' => now(),
    ];
});
