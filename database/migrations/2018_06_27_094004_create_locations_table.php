<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('core_locations', function (Blueprint $table) {
            $table->bigIncrements('location_id');
            $table->bigInteger('location_parent_id')->nullable();
            $table->string('location_name');
            $table->string('location_shortname')->nullable();
            $table->string('location_postcode')->nullable();
            $table->enum('location_type', ['provinsi','kota/kabupaten','kecamatan','desa/kelurahan']);
            $table->string('location_image')->nullable();
            $table->string('location_latitude')->nullable();
            $table->string('location_longitude')->nullable();
            $table->timestamp('location_created_at')->nullable();
            $table->timestamp('location_updated_at')->nullable();
            $table->timestamp('location_deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('locations');
    }
}
