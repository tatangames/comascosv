<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * SOLO SERAN 2 TITULOS PIE DE PAGINA
     * ID 1 Y ID 2
     */
    public function up(): void
    {
        Schema::create('titulo_piepagina', function (Blueprint $table) {
            $table->id();
            $table->string('titulo', 100);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('titulo_piepagina');
    }
};
