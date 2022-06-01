<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCalculoempTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calculoemp', function (Blueprint $table) {
            $table->id();
            $table->date('fecharet');
            $table->decimal('montodevengado', 8, 2)->nullable();
            $table->decimal('devengadobono', 8, 2)->nullable();
            $table->decimal('impuestoret', 8, 2)->nullable();
            $table->decimal('aguinaldoexen', 8, 2)->nullable();
            $table->decimal('aguinaldograv', 8, 2)->nullable();
            $table->decimal('afp', 8, 2)->nullable();
            $table->decimal('isss', 8, 2)->nullable();
            $table->decimal('inpep', 8, 2)->nullable();
            $table->decimal('ipsfa', 8, 2)->nullable();
            $table->decimal('cefafa', 8, 2)->nullable();
            $table->decimal('bienmagis', 8, 2)->nullable();
            $table->decimal('isssivm', 8, 2)->nullable();
            $table->bigInteger('empleado_id')->unsigned();
            $table->bigInteger('codigoret_id')->unsigned();

            $table->decimal('sueldo', 8, 2)->nullable();
            $table->decimal('vacaciones', 8, 2)->nullable();
            $table->decimal('crecer', 8, 2)->nullable();
            $table->decimal('horasextra', 8, 2)->nullable();
            $table->decimal('incapacidades', 8, 2)->nullable();
            $table->decimal('otrosingresos', 8, 2)->nullable();
            $table->decimal('confia', 8, 2)->nullable();
            $table->timestamps();

            $table->foreign('empleado_id')->references('id')->on('empleado');
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
        Schema::dropIfExists('calculoemp');
    }
}
