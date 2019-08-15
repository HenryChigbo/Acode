<?php

$factory->define(App\Lesson::class, function (Faker\Generator $faker) {
    return [
        "name" => $faker->name,
        "description" => $faker->name,
        "content" => $faker->name,
        "prerequisite" => $faker->name,
        "color_background" => $faker->name,
        "color_foreground" => $faker->name,
    ];
});
