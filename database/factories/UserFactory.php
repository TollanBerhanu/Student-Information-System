<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\User;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;

$factory->define(User::class, function (Faker $faker) {
    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'email' => $faker->safeEmail,
        'password' => Hash::make('password'),
        'phone_number' => $faker->unique()->phoneNumber,
        'profile' => "media/team/awol.jpg",
        'sex' => $faker->randomElement(['Male', 'Female']),
        'status' => $faker->boolean,
        'email_verified_at' => $faker->dateTime,
        'college_id' => factory(App\Model\Syncable\Program::class),
        'role_id' => factory(App\Model\Role::class),
    ];
});
