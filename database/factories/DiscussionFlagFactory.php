<?php

$factory->define(App\DiscussionFlag::class, function (Faker\Generator $faker) {
    return [
        "discussion_id" => factory('App\Discussion')->create(),
        "user_id" => factory('App\User')->create(),
        "counter" => $faker->randomNumber(2),
    ];
});
