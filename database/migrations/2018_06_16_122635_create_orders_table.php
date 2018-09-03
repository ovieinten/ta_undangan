<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('product_id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('responsible_user_id')->nullable();
            $table->string("number");
            $table->string("address");
            $table->string("village");
            $table->string("district");
            $table->string("regence");
            $table->string("province");
            $table->bigInteger("post_code")->default(0);
            $table->bigInteger("price_total")->default(0);
            $table->bigInteger("discount_total")->default(0);
            $table->bigInteger("grand_total")->default(0);
            $table->bigInteger("qty")->default(0);
            $table->date('date')->nullable();
            $table->string("desc");
            $table->string('order_number');
            $table->string("slug")->unique();
            $table->enum('status', ['payment confirmed', 'packaging', 'shipped out', 'order delivered', 'cancel'])->default('payment confirmed');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('orders', function (Blueprint $table) {

//            $table->foreign('product_id')
//                ->references('id')
//                ->on('products');
            $table->foreign('user_id')
                ->references('id')
                ->on('users');
            $table->foreign('responsible_user_id')
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
        Schema::dropIfExists('orders');
    }
}
