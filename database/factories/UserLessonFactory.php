<?php

$factory->define(App\UserLesson::class, function (Faker\Generator $faker) {
    return [
        "users_id" => factory('App\User')->create(),
        "lesson_id" => factory('App\Lesson')->create(),
    ];
});
