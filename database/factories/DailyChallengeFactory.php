<?php

$factory->define(App\DailyChallenge::class, function (Faker\Generator $faker) {
    return [
        "name" => $faker->name,
        "description" => $faker->name,
    ];
});
