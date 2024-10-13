<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('citas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_estilista');
            $table->unsignedBigInteger('id_comprador');
            $table->dateTime('fecha_hora_creacion');
            $table->dateTime('fecha_hora_inicio_cita');
            $table->dateTime('fecha_hora_fin_cita');
            $table->foreign('id_estilista')->references('id')->on('estilistas')->onDelete('cascade');
            $table->foreign('id_comprador')->references('id')->on('compradores')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('citas');
    }
};
