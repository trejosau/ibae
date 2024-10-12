<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstudianteCursoTable extends Migration
{
    public function up()
    {
        Schema::create('estudiante_curso', function (Blueprint $table) {
            $table->id(); // Crea un campo "id" auto-incremental
            $table->unsignedBigInteger('id_estudiante');
            $table->unsignedBigInteger('id_curso_apertura');
            $table->date('fecha_inscripcion');
            $table->integer('asistencia')->default(0);

            // Define las claves foráneas
            $table->foreign('id_estudiante')->references('matricula')->on('estudiantes')->onDelete('cascade');
            $table->foreign('id_curso_apertura')->references('id')->on('curso_apertura')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('estudiante_curso');
    }
}
