<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Category::class, function (Faker $faker) {
    return [
        'name' => $faker->randomElement(['Undangan Murah','Undangan Mewah','Undangan Soft Cover','Undangan Hard Cover','Undangan Promo','Undangan Unik']),
        'desc' => $faker->paragraph,
        'slug' => $faker->slug,
    ];
});
