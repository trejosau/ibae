<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('detalle_cita', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_cita');
            $table->unsignedBigInteger('id_servicio');
            $table->foreign('id_cita')->references('id')->on('citas')->onDelete('cascade');
            $table->foreign('id_servicio')->references('id')->on('servicios')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('detalle_cita');
    }
};
