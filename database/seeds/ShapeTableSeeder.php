<?php

use Illuminate\Database\Seeder;

class ShapeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\Shape::class, 10)->create();
    }
}
