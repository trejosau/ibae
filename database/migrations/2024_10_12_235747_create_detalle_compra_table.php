<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('detalle_compra', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_compra');
            $table->unsignedBigInteger('id_producto');
            $table->integer('cantidad');
            $table->foreign('id_compra')->references('id')->on('compras')->onDelete('cascade');
            $table->foreign('id_producto')->references('id')->on('productos')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('detalle_compra');
    }
};
