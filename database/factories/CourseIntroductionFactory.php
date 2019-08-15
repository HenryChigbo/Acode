<?php

$factory->define(App\CourseIntroduction::class, function (Faker\Generator $faker) {
    return [
        "title" => $faker->name,
        "description" => $faker->name,
        "course_key_id" => factory('App\Course')->create(),
    ];
});
