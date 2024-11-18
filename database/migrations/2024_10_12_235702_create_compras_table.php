<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('compras', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_proveedor');
            $table->date('fecha_compra');
            $table->date('fecha_entrega')->nullable();
            $table->enum('estado', ['entregado', 'pendiente de detalle', 'cancelado', 'pendiente de entrega']);
            $table->text('motivo')->nullable();
            $table->decimal('total', 10);
            $table->foreign('id_proveedor')->references('id')->on('proveedores')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('compras');
    }
};
