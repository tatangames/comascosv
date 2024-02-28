<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * SOLO 4 FILAS TENDRA, PARA 4 BLOQUES DE PRESENTACION
     */
    public function up(): void
    {
        Schema::create('presentacion_inicio', function (Blueprint $table) {
            $table->id();

            $table->string('titulo', 100);
            $table->text('descripcion');

            $table->string('imagen');
            $table->integer('posicion');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('presentacion_inicio');
    }
};
