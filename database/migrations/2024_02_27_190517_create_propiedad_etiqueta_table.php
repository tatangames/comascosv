<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('propiedad_etiqueta', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_propiedad')->unsigned();
            $table->bigInteger('id_etiqueta')->unsigned();

            $table->integer('posicion');

            $table->foreign('id_propiedad')->references('id')->on('propiedad');
            $table->foreign('id_etiqueta')->references('id')->on('listado_etiqueta');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('propiedad_etiqueta');
    }
};
