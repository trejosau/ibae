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
        Schema::create('estudiantes', function (Blueprint $table) {
            $table->id('matricula');
            $table->enum('estado', ['activo', 'baja'])->default('activo');
            $table->unsignedBigInteger('id_persona');
            $table->unsignedBigInteger('id_inscripcion');
            $table->date('fecha_inscripcion');
            $table->string('grado_estudio');
            $table->string('zipcode');
            $table->string('colonia');
            $table->string('calle');
            $table->string('num_ext');
            $table->string('num_int')->nullable();


            $table->foreign('id_persona')->references('id')->on('personas')->onDelete('cascade');
            $table->foreign('id_inscripcion')->references('id')->on('inscripciones')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estudiantes');
    }
};
