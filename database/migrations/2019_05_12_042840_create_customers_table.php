<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('rut')->nullable();
            $table->string('firstname');
            $table->string('lastname');
            $table->string('phone')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->timestamps();
        });

        $c = new \App\Models\Customer();
        $c->firstname = 'Alejandro';
        $c->lastname = 'Isla';
        $c->phone = '+56990684339';
        $c->email = 'aisla@innovaweb.cl';
        $c->password = bcrypt('admin123');
        $c->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
}
