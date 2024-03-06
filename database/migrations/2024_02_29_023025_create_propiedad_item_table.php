<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * LISTADO DE ITEMS PARA LA PROPIEDAD, EN TEORIA SERAN 4 ITEMS
     */
    public function up(): void
    {
        Schema::create('propiedad_item', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('id_propiedad')->unsigned();

            $table->string('nombre', 100);
            $table->integer('imagen');

            $table->foreign('id_propiedad')->references('id')->on('propiedad');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('propiedad_item');
    }
};
