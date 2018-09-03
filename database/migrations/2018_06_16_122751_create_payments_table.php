<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('confirm_user_id')->nullable();
            $table->unsignedInteger("order_id");
            $table->string("desc");
            $table->string('image')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('payments', function (Blueprint $table) {

            $table->foreign('order_id')
                ->references('id')
                ->on('orders');
            $table->foreign('user_id')
                ->references('id')
                ->on('users');
            $table->foreign('confirm_user_id')
                ->references('id')
                ->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
