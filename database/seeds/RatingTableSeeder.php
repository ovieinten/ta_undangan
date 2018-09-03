<?php

use Illuminate\Database\Capsule\Manager as DB;
use Illuminate\Database\Seeder;

class RatingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\Rating::class, 10)->create();
    }
}
