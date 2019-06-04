<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_statuses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('background')->default('#c9c9c9');
            $table->string('color')->default('#ffffff');
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
        Schema::dropIfExists('order_statuses');
    }

    private function load()
    {
        $t = new \App\Models\OrderStatus();
        $t->id = 1000;
        $t->name = 'Nuevo';
        $t->save();

        $t = new \App\Models\OrderStatus();
        $t->id = 2000;
        $t->name = 'Elaborando';
        $t->save();

        $t = new \App\Models\OrderStatus();
        $t->id = 3000;
        $t->name = 'Terminado';
        $t->save();

        $t = new \App\Models\OrderStatus();
        $t->id = 4000;
        $t->name = 'Despachado';
        $t->save();

        $t = new \App\Models\OrderStatus();
        $t->id = 5000;
        $t->name = 'Entregado';
        $t->save();
    }
}
