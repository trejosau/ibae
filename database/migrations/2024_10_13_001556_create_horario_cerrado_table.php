<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHorarioCerradoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('horario_cerrado', function (Blueprint $table) {
            $table->id();
            $table->dateTime('fecha_hora_cierre_inicio');
            $table->dateTime('fecha_hora_cierre_fin');
            $table->time('hora_fin');
            $table->string('motivo', 255);
            $table->timestamps(); // Esto agrega created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('horario_cerrado');
    }
}
