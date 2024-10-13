<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up() : void
    {
        Schema::create('horario_salon', function (Blueprint $table) {
            $table->id();
            $table->enum('dia', ['lunes', 'martes', 'miércoles', 'jueves', 'viernes', 'sábado', 'domingo']);
            $table->time('hora_apertura');
            $table->time('hora_cierre');
        });
    }

    public function down() : void
    {
        Schema::dropIfExists('horario_salon');
    }
};
