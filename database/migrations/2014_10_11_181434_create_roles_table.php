<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
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
        Schema::dropIfExists('roles');
    }

    private function load()
    {
        $rol = new \App\Models\Role();
        $rol->name = 'Administrador Gobal';
        $rol->save();

        $rol = new \App\Models\Role();
        $rol->name = 'Usuario Global';
        $rol->save();

        $rol = new \App\Models\Role();
        $rol->name = 'Admin Tienda';
        $rol->save();

        $rol = new \App\Models\Role();
        $rol->name = 'Usuario Tienda';
        $rol->save();
    }
}
