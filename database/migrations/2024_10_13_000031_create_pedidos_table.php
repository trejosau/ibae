<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            $table->decimal('total', 10);
            $table->enum('estado', ['entregado', 'listo para entrega', 'preparando para entrega']);
            $table->string('clave_entrega', 100);
            $table->unsignedBigInteger('id_comprador');
            $table->boolean('es_estudiante');
            $table->unsignedBigInteger('id_estudiante')->nullable();

            // Campos específicos para Stripe
            $table->string('stripe_payment_id')->nullable(); // ID de pago de Stripe
            $table->enum('estado_pago', ['pendiente', 'completado', 'fallido'])->default('pendiente'); // Estado del pago
            $table->timestamp('fecha_pago')->nullable(); // Fecha en la que se completó el pago
            $table->json('detalles_pago')->nullable(); // Campo JSON para guardar detalles adicionales de Stripe
            $table->foreign('id_comprador')->references('id')->on('compradores')->onDelete('cascade');
            $table->foreign('id_estudiante')->references('matricula')->on('estudiantes')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pedidos');
    }
};
