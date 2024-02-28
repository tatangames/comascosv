<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * PARA MOSTRAR EN PAGINA DE CONTACTO FRONTEND
     */
    public function up(): void
    {
        Schema::create('detalles_contacto', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('id_tipos_contactos')->unsigned();

            $table->string('nombre', 100);
            $table->integer('posicion');
            $table->boolean('visible');

            $table->foreign('id_tipos_contactos')->references('id')->on('tipos_contactos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalles_contacto');
    }
};
