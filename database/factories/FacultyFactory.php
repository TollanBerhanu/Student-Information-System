<?php

/** @var Factory $factory */

use App\Model\Syncable\Faculty;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Faculty::class, function (Faker $faker) {
    return [
        'name' => $faker->numberBetween(100,1000).$faker->unique()->firstName,
        'code' => $faker->numberBetween(100,1000).$faker->unique()->firstName,
        'college_id' => App\Model\Syncable\College::all()->random()->id,
        'description' => $faker->text,
    ];
});
