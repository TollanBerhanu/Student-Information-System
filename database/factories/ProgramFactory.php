<?php

/** @var Factory $factory */

use App\Model\Syncable\Program;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Program::class, function (Faker $faker) {
    return [
        'name' => $faker->numberBetween(100,1000).$faker->unique()->firstName,
        'code' => $faker->numberBetween(100,1000).$faker->unique()->firstName,
        'department_id' => factory(App\Model\Syncable\Department::class),
        'description' => $faker->text,
    ];
});
