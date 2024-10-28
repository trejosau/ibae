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
            $table->date('fecha_pedido');
            $table->enum('estado', ['entregado', 'listo para entrega', 'preparando para entrega']);
            $table->string('clave_entrega', 100);
            $table->unsignedBigInteger('id_comprador');
            $table->boolean('es_estudiante');
            $table->foreign('id_comprador')->references('id')->on('compradores')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pedidos');
    }
};
