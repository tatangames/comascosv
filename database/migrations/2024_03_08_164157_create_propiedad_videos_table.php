<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * LISTA DE VIDEOS DE PROPIEDAD
     */
    public function up(): void
    {
        Schema::create('propiedad_videos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_propiedad')->unsigned();

            $table->string('url_video', 100);
            $table->string('titulo', 300)->nullable();

            $table->integer('posicion');

            $table->foreign('id_propiedad')->references('id')->on('propiedad');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('propiedad_videos');
    }
};
