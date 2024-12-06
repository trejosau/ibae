<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('citas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_estilista');
            $table->unsignedBigInteger('id_comprador')->nullable();
            $table->string('cliente')->nullable();
            $table->dateTime('fecha_hora_creacion')->nullable();
            $table->dateTime('fecha_hora_inicio_cita')->nullable();
            $table->dateTime('fecha_hora_fin_cita')->nullable();
            $table->decimal('total', 10, 2);
            $table->decimal('anticipo', 10, 2)->nullable();
            $table->decimal('pago_restante', 10, 2)->default(0); // Nuevo campo agregado
            $table->enum('estado_pago', ['concluido', 'anticipo']);
            $table->enum('estado_cita', ['programada', 'reprogramada', 'cancelada', 'completada'])->default('programada');
            $table->dateTime('nueva_fecha_hora_inicio_cita')->nullable();
            $table->string('motivo_reprogramacion')->nullable();
            $table->foreign('id_estilista')->references('id')->on('estilistas')->onDelete('cascade');
            $table->foreign('id_comprador')->references('id')->on('compradores')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('citas');
    }
};
