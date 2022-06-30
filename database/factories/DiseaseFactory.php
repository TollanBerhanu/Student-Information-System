<?php

/** @var Factory $factory */


use App\Model\Clinic\Disease;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Disease::class, function (Faker $faker) {
    return [
        'name' => $faker->numberBetween(100,1000).$faker->unique()->firstName,
        'code' => $faker->numberBetween(100,1000).$faker->unique()->firstName,
        'description' => $faker->text,
    ];
});
