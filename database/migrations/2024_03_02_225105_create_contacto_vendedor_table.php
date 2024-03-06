<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * LISTA DE CONTACTOS PARA EL VENDEDOR
     */
    public function up(): void
    {
        Schema::create('contacto_vendedor', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('id_vendedor')->unsigned();
            $table->bigInteger('id_tipocontacto')->unsigned();

            $table->string('titulo', 300);
            $table->integer('posicion');

            $table->foreign('id_vendedor')->references('id')->on('vendedores');
            $table->foreign('id_tipocontacto')->references('id')->on('tipo_contacto_vendedor');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacto_vendedor');
    }
};
