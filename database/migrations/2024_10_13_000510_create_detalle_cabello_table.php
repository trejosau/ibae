<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('detalle_cabello', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_detalle_cita');
            $table->enum('largo', ['corto', 'medio', 'largo', 'extra-largo']);
            $table->enum('volumen', ['bajo', 'medio', 'alto']);
            $table->enum('estado', ['natural', 'teñido', 'decolorado/procesado', 'teñido oscuro o rojizo']);
            $table->foreign('id_detalle_cita')->references('id')->on('detalle_cita')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('detalle_cabello');
    }
};
