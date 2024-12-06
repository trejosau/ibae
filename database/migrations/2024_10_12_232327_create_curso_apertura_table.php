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
            $table->foreignId('id_curso')->constrained('cursos')->onDelete('cascade');
            $table->string('nombre');
            $table->date('fecha_inicio');
            $table->decimal('monto_colegiatura');
            $table->enum('dia_clase', ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo']);
            $table->time('hora_clase')->nullable();
            $table->time('hora_clase_fin')->nullable();
            $table->foreignId('id_profesor')->nullable()->constrained('profesores');
            $table->enum('estado', ['programado', 'finalizado', 'en curso'])->default('programado');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('curso_apertura');
    }
};
