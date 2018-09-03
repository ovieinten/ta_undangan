<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('order_id');
            $table->unsignedInteger('payment_id');
            $table->bigInteger("paid_total")->default(0);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('sales', function (Blueprint $table) {

            $table->foreign('order_id')
                ->references('id')
                ->on('orders');
            $table->foreign('payment_id')
                ->references('id')
                ->on('payments');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales');
    }
}
