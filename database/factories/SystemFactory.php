<?php

/** @var Factory $factory */

use App\Model\System;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(System::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->firstName,
        'description' => $faker->text,
    ];
});
