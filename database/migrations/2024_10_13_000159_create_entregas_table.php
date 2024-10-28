<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('entregas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_pedido');
            $table->unsignedBigInteger('id_admin');
            $table->dateTime('fecha_hora_entregado')->nullable();
            $table->dateTime('fecha_hora_listo_entregar')->nullable();
            $table->enum('estado', ['listo entregar', 'entregado']);
            $table->string('nombre_recolector');

            $table->foreign('id_pedido')->references('id')->on('pedidos')->onDelete('cascade');
            $table->foreign('id_admin')->references('id')->on('administradores')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('entregas');
    }
};
