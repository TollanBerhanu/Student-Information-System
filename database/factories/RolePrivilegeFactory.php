<?php

/** @var Factory $factory */

use App\Model\RolePrivilege;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(RolePrivilege::class, function (Faker $faker) {
    return [
        'privilege_id' => factory(App\Model\Privilege::class),
        'role_id' => factory(App\Model\Role::class),
        'status' => $faker->boolean,
    ];
});
