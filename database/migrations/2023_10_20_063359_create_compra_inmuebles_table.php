<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompraInmueblesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compra_inmuebles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tipo_inmueble');
            $table->string('presupuesto');
            $table->string('ubicacion');
            $table->string('recursos_propios');
            $table->string('tipo_credito')->nullable();
            $table->string('tipo_credito_especifico')->nullable();
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
        Schema::dropIfExists('compra_inmuebles');
    }
}
