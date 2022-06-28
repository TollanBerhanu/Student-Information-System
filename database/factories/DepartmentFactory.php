<?php

/** @var Factory $factory */

use App\Model\Syncable\Department;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Department::class, function (Faker $faker) {
    return [
        'name' => $faker->numberBetween(100,1000).$faker->unique()->firstName,
        'code' => $faker->numberBetween(100,1000).$faker->unique()->firstName,
        'faculty_id' => factory(App\Model\Syncable\Faculty::class),
        'description' => $faker->text,
    ];
});
