<?php

use Faker\Generator as Faker;

$factory->define(App\Schedule::class, function (Faker $faker) {
    return [
        'employee_id' => function () {
            return factory(\App\Employee::class)->create()->id;
        },
        'time_from' => now()->toDateTimeString(),
        'time_to' => now()->addHours(8)->toDateTimeString(),
    ];
});
