<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCalculoproTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calculopro', function (Blueprint $table) {
            $table->id();
            $table->date('fecharet');
            $table->string('partida');
            $table->string('arrendamiento');
            $table->string('numfactura');
            $table->decimal('monto', 8, 2);
            $table->decimal('montoret', 8, 2);
            $table->bigInteger('proveedor_id')->unsigned();
            $table->bigInteger('codigoret_id')->unsigned();
            $table->timestamps();

            
            $table->foreign('proveedor_id')->references('id')->on('proveedor');
            $table->foreign('codigoret_id')->references('id')->on('codigoret');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('calculopro');
    }
}
