<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * SOLO PARA ETIQUETAS DE 2 ESTILOS
     */
    public function up(): void
    {
        Schema::create('propiedad_tipo_detalle', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('propiedad_tipo_detalle');
    }
};
