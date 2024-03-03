<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * LISTA DE DETALLES PARA UNA PROPIEDAD
     */
    public function up(): void
    {
        Schema::create('propiedad_detalle', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('id_propiedad')->unsigned();
            $table->bigInteger('id_tipodetalle')->unsigned();

            $table->string('titulo', 100);
            $table->string('descripcion', 200)->nullable();
            $table->integer('posicion');

            $table->foreign('id_propiedad')->references('id')->on('propiedad');
            $table->foreign('id_tipodetalle')->references('id')->on('propiedad_tipo_detalle');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('propiedad_detalle');
    }
};
