<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpleadoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empleado', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('apellido');
            $table->string('dui');
            $table->string('nit');
            $table->string('domiciliado')->nullable();
            $table->bigInteger('codigopais_id')->unsigned();
            $table->string('activo')->nullable();
            $table->timestamps();

            $table->foreign('codigopais_id')->references('id')->on('codigopais');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('empleado');
    }
}
