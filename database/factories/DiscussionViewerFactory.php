<?php

$factory->define(App\DiscussionViewer::class, function (Faker\Generator $faker) {
    return [
        "discussion_id" => factory('App\Discussion')->create(),
        "counter" => $faker->randomNumber(2),
    ];
});
