<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('curso_apertura', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_curso')->constrained('cursos');
            $table->string('nombre');
            $table->date('fecha_inicio');
            $table->string('periodo')->nullable();
            $table->year('año');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('curso_apertura');
    }
};
