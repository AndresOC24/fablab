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
        Schema::create('voluntarios', function (Blueprint $table) {
            $table->id(); // Identificador único
            $table->string('nombre'); // Nombre del voluntario
            $table->string('apellido'); // Apellido del voluntario
            $table->string('ci')->unique(); // Cédula de identidad, único
            $table->date('fecha_nacimiento'); // Fecha de nacimiento
            $table->string('email')->unique(); // Email único
            $table->boolean('estado')->default(true); // Estado del voluntario (activo o inactivo)
            $table->string('telefono')->nullable(); // Teléfono opcional
            $table->string('universidad')->nullable(); // Universidad opcional
            $table->text('extra')->nullable(); // Campo extra para información adicional
            $table->timestamps(); // Campos created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('voluntarios');
    }
};
