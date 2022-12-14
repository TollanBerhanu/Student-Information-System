<?php

/** @var Factory $factory */

use App\Model\Syncable\Program;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Program::class, function (Faker $faker) {
    return [
        'name' => $faker->numberBetween(100,1000).$faker->unique()->firstName,
        'code' => $faker->numberBetween(100,1000).$faker->unique()->firstName,
        'department_id' => App\Model\Syncable\Department::all()->random()->id,
        'description' => $faker->text,
    ];
});
