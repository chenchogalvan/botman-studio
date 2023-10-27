<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRentaInmuebleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('renta_inmueble', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre_completo');
            $table->string('telefono');
            $table->string('correo');
            $table->string('tipo_inmueble');
            $table->string('presupuesto');
            $table->integer('personas');
            $table->string('duracion');
            $table->string('mascotas');
            $table->string('ninos');
            $table->string('lugar_trabajo');
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
        Schema::dropIfExists('renta_inmueble');
    }
}
