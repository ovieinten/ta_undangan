<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Shape::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'slug' => $faker->slug,
    ];
});
