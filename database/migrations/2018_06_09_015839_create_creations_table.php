<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCreationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('creations', function (Blueprint $table) {
            $table->increments('id');
            $table->string("name");
            $table->bigInteger("price")->default(0);
            $table->string("desc");
            $table->string("slug")->unique();
            $table->unsignedBigInteger('shape_id');
            $table->unsignedBigInteger('color_id');
            $table->unsignedBigInteger('size_id');
            $table->unsignedBigInteger('user_id');
            $table->enum('status', ['sent', 'accepted'])->default('sent');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('creations', function (Blueprint $table) {

            $table->foreign('color_id')
                ->references('id')
                ->on('colors')
                ->onUpdate('cascade')
                ->onDelete('restrict');
            $table->foreign('size_id')
                ->references('id')
                ->on('sizes')
                ->onUpdate('cascade')
                ->onDelete('restrict');
            $table->foreign('shape_id')
                ->references('id')
                ->on('shapes')
                ->onUpdate('cascade')
                ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('creations');
    }
}
