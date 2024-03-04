<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * SOLO HABRA 1 FILA
     */
    public function up(): void
    {
        Schema::create('recursos', function (Blueprint $table) {
            $table->id();

            // PARA PAGINA QUIENES SOMOS
            $table->text('quienes_somos');

            // PARA PAGINA CONTACTO
            $table->string('detalle_contacto', 100);

            // PARA MOSTRAR WHASSAP EN VARIAS PARTES DE LA WEB
            $table->string('telefono', 25)->nullable();


            // PIE DE PAGINA UN TEXTO DEBAJO DEL LOGO
            $table->string('descripcion_pagina', 200)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recursos');
    }
};
