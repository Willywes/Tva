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
            $table->bigIncrements('id');
            $table->bigInteger('customer_id')->unsigned()->nullable();
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('set null');
            $table->integer('subtotal');
            $table->integer('dispatch_amount')->nullable();
            $table->integer('total');
            $table->string('payment')->nullable();
            $table->text('comments')->nullable();
            $table->bigInteger('order_type_id')->unsigned()->nullable();
            $table->foreign('order_type_id')->references('id')->on('order_types')->onDelete('set null');
            $table->bigInteger('order_status_id')->unsigned()->nullable();
            $table->foreign('order_status_id')->references('id')->on('order_statuses')->onDelete('set null');
            $table->bigInteger('customer_address_id')->unsigned()->nullable();
            $table->foreign('customer_address_id')->references('id')->on('customer_addresses')->onDelete('set null');
            $table->bigInteger('shop_id')->unsigned()->nullable();
            $table->foreign('shop_id')->references('id')->on('shops')->onDelete('set null');
            $table->timestamps();
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
