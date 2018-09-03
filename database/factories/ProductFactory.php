<?php

use Faker\Generator as Faker;

$factory->define(App\Product::class, function (Faker $faker) {
    return [
        'category_id' => $faker->randomElement(['1','2','3','4','5','6']),
        'shape_id' => $faker->randomElement(['1','2','3','4','5','6']),
        'color_id' => $faker->randomElement(['1','2','3','4','5','6']),
        'size_id' => $faker->randomElement(['1','2','3','4','5','6']),
        'user_id' => $faker->randomElement(['1','2','3']),
        'name' => $faker->firstName,
        'slug' => $faker->slug,
        'desc' => $faker->paragraph,
        'avatar' => $faker->imageUrl(),
        'gender' => $faker->randomElement(['pria','wanita']),
        'birth_place' => $faker->city,
        'phone' => $faker->phoneNumber,
        'address' => $faker->address,
        'birth_date' => $faker->date(),
        'remember_token' => str_random(10),
    ];
});
