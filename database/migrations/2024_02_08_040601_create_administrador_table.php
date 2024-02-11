<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * UTILIZADO POR ADMINISTRADOR Y CLIENTES
     */
    public function up(): void
    {
        Schema::create('administrador', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 50);
            $table->string('apellido', 50)->nullable();

            // puede ser usuario/telefono/correo
            $table->string('usuario', 100)->unique();

            // 20 caracteres en password
            $table->string('password', 255);


            $table->string('correo', 100)->nullable();
            $table->string('token_correo', 100)->nullable();
            $table->dateTime('token_fecha')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('administrador');
    }
};
