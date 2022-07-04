<?php

/** @var Factory $factory */

use App\Model\Syncable\Student;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Student::class, function (Faker $faker) {
    return [
        'first_name' => $faker->firstName,
        'middle_name' => $faker->lastName,
        'last_name' => $faker->lastName,
        'email' => $faker->safeEmail,
        'phone_number' => $faker->unique()->phoneNumber,
        'profile' => "media/team/awol.jpg",
        'dob' => $faker->date,
        'sex' => $faker->randomElement(['Male', 'Female']),
        'status' => true,
        'join_year' => $faker->date,
        'passed_semester' => $faker->numberBetween(1,10),
        'taken_semester' => $faker->numberBetween(1,10),
        'student_id' => "RU".$faker->numberBetween(1000,9999).'/'.$faker->numberBetween(10,15),
        'program_id' => App\Model\Syncable\Program::all()->random()->id,
    ];
});
