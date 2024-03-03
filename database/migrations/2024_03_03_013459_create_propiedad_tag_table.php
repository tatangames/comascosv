<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * ETIQUETA POPULAR, AL TOCAR CARGARA OTRA VENTANA CON LAS PROPIEDAD SIMILARES
     */
    public function up(): void
    {
        Schema::create('propiedad_tag', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_propiedad')->unsigned();

            $table->string('nombre', 100);

            $table->foreign('id_propiedad')->references('id')->on('propiedad');
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
