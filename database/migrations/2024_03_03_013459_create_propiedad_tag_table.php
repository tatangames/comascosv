<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * ETIQUETA POPULAR, AL TOCAR CARGARA OTRA VENTANA CON LAS PROPIEDAD SIMILARES
     *
     */
    public function up(): void
    {
        Schema::create('propiedad_tag', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_propiedad')->unsigned();
            $table->bigInteger('id_tag_popular')->unsigned();



            $table->foreign('id_propiedad')->references('id')->on('propiedad');
            $table->foreign('id_tag_popular')->references('id')->on('etiquetas_populares');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('propiedad_tag');
    }
};
