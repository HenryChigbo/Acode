<?php

$factory->define(App\Discussion::class, function (Faker\Generator $faker) {
    return [
        "question" => $faker->name,
        "tags" => collect(["Android","iOS","Flutter","React Native","Xamarin",])->random(),
        "description" => $faker->name,
        "post" => $faker->name,
        "user_id" => factory('App\User')->create(),
    ];
});
