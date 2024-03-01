<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * BASE DE PROPIEDAD
     */
    public function up(): void
    {
        Schema::create('propiedad', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('id_vendedor')->unsigned();
            $table->bigInteger('id_lugar')->unsigned();

            $table->date('fecha'); // fecha registro
            $table->string('nombre', 100);
            $table->string('direccion', 100)->nullable();

            $table->decimal('precio', 10, 2)->nullable();

            // fechas para mostrar visibilidad
            $table->date('fecha_inicio');
            $table->date('fecha_fin');

            $table->string('latitud', 100)->nullable();
            $table->string('longitud', 100)->nullable();

            $table->string('vineta_izquierda', 50)->nullable();
            $table->string('vineta_derecha', 50)->nullable();

            $table->string('slug', 150)->unique();

            $table->string('video_url', 100)->nullable();
            // es la imagen de portada preview video
            $table->string('video_imagen', 100)->nullable();

            $table->text('descripcion')->nullable();

            $table->foreign('id_vendedor')->references('id')->on('vendedores');
            $table->foreign('id_lugar')->references('id')->on('lugares');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('propiedad');
    }
};
