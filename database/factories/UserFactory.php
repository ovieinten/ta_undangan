<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'role_id' => $faker->randomElement(['1','2','3']),
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'avatar' => $faker->imageUrl(),
        'gender' => $faker->randomElement(['pria','wanita']),
        'birth_place' => $faker->city,
        'phone' => $faker->phoneNumber,
        'birth_date' => $faker->date(),
        'remember_token' => str_random(10),
    ];
});
