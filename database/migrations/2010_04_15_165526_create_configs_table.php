<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfigsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('configs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('store_name')->default('Mi Tienda');
            $table->longText('store_description')->nullable();
            $table->longText('address')->nullable();
            $table->string('store_phone_one')->nullable();
            $table->string('store_phone_two')->nullable();
            $table->string('store_email')->nullable();
            $table->boolean('taxes')->default(1);
            $table->float('tax_value', 5, 2)->default(19.00);
            $table->boolean('tax_included_price')->default(1);

            $table->timestamps();
        });

        $this->load();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('configs');
    }

    private function load()
    {
        $config = new \App\Models\Config();
        $config->save();

//        $config = new \App\Model\Config();
//        $config->name = 'store_name';
//        $config->value = 'Mi Tienda';
//        $config->save();
//
//        $config = new \App\Model\Config();
//        $config->name = 'store_description';
//        $config->value = 'Mi tienda en laravel';
//        $config->save();
//
//        $config = new \App\Model\Config();
//        $config->name = 'store_phone_one';
//        $config->save();
//
//        $config = new \App\Model\Config();
//        $config->name = 'store_phone_two';
//        $config->save();
//
//        $config = new \App\Model\Config();
//        $config->name = 'store_email';
//        $config->save();
//
//        $config = new \App\Model\Config();
//        $config->name = 'store_address';
//        $config->save();
//
//        $config = new \App\Model\Config();
//        $config->name = 'taxes';
//        $config->value = 'yes';
//        $config->save();
//
//        $config = new \App\Model\Config();
//        $config->name = 'tax_value';
//        $config->value = '19.00';
//        $config->save();
//
//        $config = new \App\Model\Config();
//        $config->name = 'tax_included_price';
//        $config->value = 'yes';
//        $config->save();
    }
}
