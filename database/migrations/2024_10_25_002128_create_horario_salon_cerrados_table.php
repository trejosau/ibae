<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHorarioSalonCerradosTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('horario_salon_cerrado', function (Blueprint $table) {
            $table->id(); // ID autoincremental
            $table->dateTime('fecha_hora_cierre_inicio');
            $table->dateTime('fecha_hora_cierre_fin');
            $table->time('hora_fin');
            $table->string('motivo', 255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('horariosaloncerrado');
    }
}
