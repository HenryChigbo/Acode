<?php

$factory->define(App\DailyChallengeFlag::class, function (Faker\Generator $faker) {
    return [
        "counter" => $faker->randomNumber(2),
        "daily_challenge_id" => factory('App\DailyChallenge')->create(),
    ];
});
