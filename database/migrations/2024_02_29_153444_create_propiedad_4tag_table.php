<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * LA PROPIEDAD TENDRA X TAG QUE APARECEN EN INICIO, Y SOLO
     * APARECEN AHI
     */
    public function up(): void
    {
        Schema::create('propiedad_4tag', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('id_propiedad')->unsigned();
            $table->bigInteger('id_imagen4tag')->unsigned();

            $table->string('nombre', 100);
            $table->integer('posicion');

            $table->foreign('id_propiedad')->references('id')->on('propiedad');
            $table->foreign('id_imagen4tag')->references('id')->on('propiedad_imagen4tag');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('propiedad_4tag');
    }
};
