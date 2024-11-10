<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('categorias_servicios', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
        });

        Schema::create('servicios', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->text('descripcion')->nullable();
            $table->decimal('precio', 10);
            $table->integer('duracion_maxima');
            $table->integer('duracion_minima');
            $table->foreignId('categoria')->constrained('categorias_servicios')->onDelete('cascade');
            $table->enum('estado', ['activo', 'inactivo'])->default('activo');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('servicios');
    }
};
