<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRentaPropiedadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('renta_propiedads', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tipo_inmueble');
            $table->string('presupuesto');
            $table->string('ubicacion');
            $table->string('duracion_contrato');
            $table->string('acepta_mascotas');
            $table->string('acepta_ninos');
            $table->text('descripcion');
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
        Schema::dropIfExists('renta_propiedads');
    }
}
