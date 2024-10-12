<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('modulo_curso', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_modulo');
            $table->unsignedBigInteger('id_curso');
            $table->integer('orden');
            $table->unsignedBigInteger('id_profesor')->nullable();
            $table->foreign('id_profesor')->references('id')->on('profesores')->onDelete('cascade');
            $table->foreign('id_modulo')->references('id')->on('modulos')->onDelete('cascade');
            $table->foreign('id_curso')->references('id')->on('cursos')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('modulo_curso');
    }
};
