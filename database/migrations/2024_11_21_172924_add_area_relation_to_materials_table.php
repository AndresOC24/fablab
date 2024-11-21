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
        Schema::table('materials', function (Blueprint $table) {
            $table->foreignId('id_areas')
            ->constrained('areas') // Relación con la tabla areas
            ->onDelete('cascade') // Elimina materiales si el área es eliminada
            ->after('id'); // Colocar el campo después del id

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('materials', function (Blueprint $table) {
            $table->dropForeign(['id_areas']); // Eliminar la clave foránea
            $table->dropColumn('id_areas'); // Eliminar el campo
        });
    }
};
