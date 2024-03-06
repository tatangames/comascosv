<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * LISTADO DE PREGUNTAS FRECUENTES
     */
    public function up(): void
    {
        Schema::create('preguntas_frecuentes', function (Blueprint $table) {
            $table->id();
            $table->string('titulo', 800);
            $table->string('descripcion', 1500);
            $table->integer('posicion');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('preguntas_frecuentes');
    }
};
