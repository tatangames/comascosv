<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * MAXIMO 10 PROPIEDADES PRINCIPALES QUE SE MOSTRARAN
     */
    public function up(): void
    {
        Schema::create('propiedad_inicio', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('id_propiedad')->unsigned();

            $table->integer('posicion');

            $table->foreign('id_propiedad')->references('id')->on('propiedad');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('propiedad_inicio');
    }
};
