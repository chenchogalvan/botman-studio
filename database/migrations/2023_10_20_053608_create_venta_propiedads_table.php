<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVentaPropiedadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('venta_propiedads', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ubicacion');
            $table->string('precio');
            $table->string('adeudo')->nullable();
            $table->string('numero_credito')->nullable();
            $table->string('adeudo_monto')->nullable();
            $table->string('institucion_financiera')->nullable();
            $table->string('terreno_metros')->nullable();
            $table->string('construidos_metros')->nullable();
            $table->string('escrituras')->nullable();
            $table->text('descripcion')->nullable();
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
        Schema::dropIfExists('venta_propiedads');
    }
}
