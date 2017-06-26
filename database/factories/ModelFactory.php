<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(Auxys\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});


$factory->define(Auxys\Student::class, function (Faker\Generator $faker) {
    return [
        'nombre' => $faker->name,
        'ci' => strval($faker->numberBetween($min = 1000, $max = 9000)),
        'matricula' => strval($faker->numberBetween($min = 1000, $max = 9000))
    ];
});


