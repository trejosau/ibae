<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ventas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_comprador');
            $table->timestamp('fecha_compra');
            $table->decimal('total', 10 );
            $table->unsignedBigInteger('id_admin');
            $table->enum('es_estudiante', ['si', 'no']);
            $table->unsignedBigInteger('matricula')->nullable();
            $table->foreign('matricula')->references('matricula')->on('estudiantes');
            $table->foreign('id_admin')->references('id')->on('administradores')->onDelete('cascade');
            });
    }

    public function down(): void
    {
        Schema::dropIfExists('ventas');
    }
};
