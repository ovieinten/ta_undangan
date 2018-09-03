<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string("name");
            $table->bigInteger("price")->default(0);
            $table->string("desc");
            $table->string("slug")->unique();
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('shape_id');
            $table->unsignedBigInteger('color_id');
            $table->unsignedBigInteger('size_id');
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')
                ->references('id')
                ->on('users');
            $table->enum('status', ['publish', 'draft', 'trash'])->default('draft');
            $table->string("note")->nullable();
            $table->timestamps();
            $table->softDeletes();

        });

        Schema::table('products', function (Blueprint $table) {

            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->onUpdate('cascade')
                ->onDelete('restrict');
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
        Schema::dropIfExists('products');
    }
}
