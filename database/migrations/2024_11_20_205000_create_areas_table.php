<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAreasTable extends Migration
{
    public function up()
    {
        Schema::create('areas', function (Blueprint $table) {
            $table->id(); // Identificador único
            $table->string('nombre'); // Nombre del área
            $table->text('descripcion')->nullable(); // Descripción del área
            $table->timestamps(); // Timestamps (created_at y updated_at)
        });
    }

    public function down()
    {
        Schema::dropIfExists('areas');
    }
}
