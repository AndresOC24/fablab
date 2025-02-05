<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prestamos', function (Blueprint $table) {
            $table->id(); // pk int id
            $table->foreignId('voluntarios_id')->constrained('voluntarios')->onDelete('cascade'); // fk int voluntarios_id
            $table->foreignId('material_id')->constrained('materials')->onDelete('cascade'); // fk int material_id
            $table->integer('cantidad'); // int cantidad
            $table->date('fecha_prestamo'); // date fecha_prestamo
            $table->date('fecha_devolucion')->nullable(); // date fecha_devolución
            $table->boolean('estado'); // bool estado
            $table->text('observaciones')->nullable(); // text observaciones
            $table->timestamps(); // timestamp created_at, updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prestamos');
    }
};
