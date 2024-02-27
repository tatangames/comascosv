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

            $table->date('fecha'); // fecha registro
            $table->string('nombre', 100);
            $table->string('direccion', 100)->nullable();

            $table->decimal('precio', 10, 2);

            // fechas para mostrar visibilidad
            $table->date('fecha_inicio');
            $table->date('fecha_fin');

            $table->foreign('id_vendedor')->references('id')->on('vendedores');
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
