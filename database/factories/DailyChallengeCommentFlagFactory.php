<?php

$factory->define(App\DailyChallengeCommentFlag::class, function (Faker\Generator $faker) {
    return [
        "counter" => $faker->randomNumber(2),
        "user_id" => factory('App\User')->create(),
        "daily_challenge_comment_id" => factory('App\DailyChallengeComment')->create(),
    ];
});
