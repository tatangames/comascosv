<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * LISTADO DE IMAGENES 360
     */
    public function up(): void
    {
        Schema::create('propiedad_imagen360', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('id_propiedad')->unsigned();

            $table->string('imagen', 100);
            $table->integer('posicion');

            $table->foreign('id_propiedad')->references('id')->on('propiedad');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('propiedad_imagen360');
    }
};
