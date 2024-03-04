<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('descripcion_piepagina', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_titulopiepagina')->unsigned();

            $table->string('nombre', 500);
            $table->integer('posicion');

            $table->foreign('id_titulopiepagina')->references('id')->on('titulo_piepagina');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('descripcion_piepagina');
    }
};
