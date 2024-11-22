<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('maquinas', function (Blueprint $table) {
            $table->id(); // Identificador único
            $table->string('nombre'); // Nombre de la máquina
            $table->text('descripcion')->nullable(); // Descripción de la máquina
            $table->string('modelo')->nullable(); // Modelo de la máquina
            $table->string('numero_serie')->nullable(); // Número de serie único
            $table->foreignId('id_areas')->constrained('areas')->onDelete('cascade'); // Relación con la tabla áreas
            $table->string('observaciones')->nullable(); // Observaciones
            $table->string('imagen')->nullable(); // Ruta de la imagen
            $table->timestamps(); // Timestamps (created_at y updated_at)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maquinas');
    }
};
