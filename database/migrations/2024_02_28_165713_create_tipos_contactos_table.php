<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * TIPOS DE CONTACOS PARA MOSTRAR EN PAGINA CONTACTOS
     */
    public function up(): void
    {
        Schema::create('tipos_contactos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 50);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tipos_contactos');
    }
};
