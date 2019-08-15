<?php

$factory->define(App\DiscussionComment::class, function (Faker\Generator $faker) {
    return [
        "comment" => $faker->name,
        "discussion_id" => factory('App\Discussion')->create(),
        "user_id" => factory('App\User')->create(),
    ];
});
