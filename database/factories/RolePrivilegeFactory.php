<?php

/** @var Factory $factory */

use App\Model\RolePrivilege;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(RolePrivilege::class, function (Faker $faker) {
    return [
        'privilege_id' => App\Model\Privilege::all()->random()->id,
        'role_id' => App\Model\Role::all()->random()->id,
        'status' => $faker->boolean,
    ];
});
