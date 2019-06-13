<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCartItemAttributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart_item_attributes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('cart_item_id')->unsigned()->nullable();
            $table->foreign('cart_item_id')->references('id')->on('cart_items')->onDelete('cascade');
            $table->bigInteger('product_attribute_id')->unsigned()->nullable();
            $table->foreign('product_attribute_id')->references('id')->on('product_attributes')->onDelete('cascade');
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
        Schema::dropIfExists('cart_item_attributes');
    }
}
