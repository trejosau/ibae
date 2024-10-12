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
            $table->unsignedBigInteger('id_comprador');
            $table->date('fecha_compra');
            $table->decimal('total', 10, 2);
            $table->unsignedBigInteger('id_admin');
            $table->enum('es_estudiante', ['si', 'no']);
            $table->foreign('id_admin')->references('id')->on('administradores')->onDelete('cascade');
            $table->foreign('id_comprador')->references('id')->on('compradores')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ventas');
    }
};
