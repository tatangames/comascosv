<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * para vision, mision
     */
    public function up(): void
    {
        Schema::create('recursos2', function (Blueprint $table) {
            $table->id();
            $table->integer('posicion');

            $table->string('titulo', 300)->nullable();
            $table->text('mensaje')->nullable();

            $table->boolean('activo');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recursos2');
    }
};
