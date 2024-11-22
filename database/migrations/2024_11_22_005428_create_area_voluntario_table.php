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
        Schema::create('area_voluntario', function (Blueprint $table) {
            $table->id(); // Identificador único
            $table->foreignId('area_id')->constrained('areas')->onDelete('cascade'); // Relación con la tabla áreas
            $table->foreignId('voluntario_id')->constrained('voluntarios')->onDelete('cascade'); // Relación con la tabla voluntarios
            $table->timestamps(); // Campos created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('area_voluntario');
    }
};
