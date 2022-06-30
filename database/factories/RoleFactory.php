<?php

/** @var Factory $factory */

use App\Model\Role;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Role::class, function (Faker $faker) {
    return [
        'name' => $faker->numberBetween(100,1000).$faker->unique()->firstName,
        'system_id' => App\Model\System::all()->random()->id,
        'description' => $faker->text,
    ];
});
