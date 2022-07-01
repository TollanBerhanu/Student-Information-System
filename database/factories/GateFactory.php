<?php

/** @var Factory $factory */

use App\Model\Syncable\Gate;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Gate::class, function (Faker $faker) {
    return [
        'gate_name' => $faker->numberBetween(100,1000).$faker->unique()->firstName,
        'college_id' => App\Model\Syncable\College::all()->random()->id,
    ];
});
