<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('estudiante_curso', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_estudiante');
            $table->unsignedBigInteger('id_curso_apertura');
            $table->date('fecha_inscripcion');
            $table->integer('asistencia')->default(0);
            $table->foreign('id_estudiante')->references('matricula')->on('estudiantes');
            $table->foreign('id_curso_apertura')->references('id')->on('curso_apertura');

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('estudiante_curso');
    }

    };
