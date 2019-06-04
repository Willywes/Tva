<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
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
        Schema::dropIfExists('order_types');
    }

    private function load()
    {
        $t = new \App\Models\OrderType();
        $t->id = 1000;
        $t->name = 'Retiro en Tienda';
        $t->save();

        $t = new \App\Models\OrderType();
        $t->id = 2000;
        $t->name = 'Despacho a Domicilio';
        $t->save();
    }
}
