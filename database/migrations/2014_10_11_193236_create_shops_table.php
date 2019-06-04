<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shops', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('rut')->nullable();
            $table->string('business_name');
            $table->string('shop_name')->default('Mi Tienda');
            $table->longText('shop_description')->nullable();
            $table->longText('address')->nullable();
            $table->string('shop_phone_one')->nullable();
            $table->string('shop_phone_two')->nullable();
            $table->string('shop_email')->nullable();
            $table->boolean('taxes')->default(1);
            $table->float('tax_value', 5, 2)->default(19.00);
            $table->boolean('tax_included_price')->default(1);
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
        Schema::dropIfExists('shops');
    }
}
