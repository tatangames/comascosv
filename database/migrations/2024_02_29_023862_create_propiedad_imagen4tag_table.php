<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * IMAGENES PARA ETIQUETAS QUE APARECE EN INICIO PARA UNA PROPIEDAD
     *
     * IMAGENES RECOMENDADO 256 PX
     */
    public function up(): void
    {
        Schema::create('propiedad_imagen4tag', function (Blueprint $table) {
            $table->id();

            $table->string('nombre', 100);
            $table->string('imagen', 100);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('propiedad_imagen4tag');
    }
};
