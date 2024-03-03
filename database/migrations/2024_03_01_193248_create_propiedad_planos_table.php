<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * LISTA DE IMAGEN PLANOS PARA PROPIEDAD
     */
    public function up(): void
    {
        Schema::create('propiedad_planos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_propiedad')->unsigned();

            $table->string('imagen', 100);
            $table->integer('posicion');

            $table->foreign('id_propiedad')->references('id')->on('propiedad');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('propiedad_planos');
    }
};
