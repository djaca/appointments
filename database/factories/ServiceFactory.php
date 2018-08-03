<?php

use Faker\Generator as Faker;

$factory->define(App\Service::class, function (Faker $faker) {
    return [
        'name' => $faker->words(3, true),
        'duration' => ceil($faker->numberBetween(15, 120) / 5) * 5,
        'price' => $faker->randomFloat(2, 150, 500),
    ];
});
