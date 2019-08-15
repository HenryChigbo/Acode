<?php

$factory->define(App\DailyChallengeComment::class, function (Faker\Generator $faker) {
    return [
        "comment" => $faker->name,
        "daily_challenge_id" => factory('App\DailyChallenge')->create(),
        "user_id" => factory('App\User')->create(),
    ];
});
