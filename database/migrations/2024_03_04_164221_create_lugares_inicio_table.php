<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * LISTA DE UBICACIONES PARA PAGINA INICIO
     */
    public function up(): void
    {
        Schema::create('lugares_inicio', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_lugares')->unsigned();

            $table->integer('posicion');

            $table->foreign('id_lugares')->references('id')->on('lugares');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lugares_inicio');
    }
};
