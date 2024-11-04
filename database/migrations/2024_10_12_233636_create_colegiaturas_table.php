<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('colegiaturas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_estudiante_curso');
            $table->integer('semana')->comment('Número de la semana');
            $table->tinyInteger('asistio')->default(0)->comment('1 = Asistió, 0 = No asistió');
            $table->tinyInteger('colegiatura')->default(0)->comment('1 = Pagado, 0 = Pendiente');
            $table->date('fecha_pago')->nullable()->comment('Fecha en que se realizó el pago');
            $table->foreign('id_estudiante_curso')->references('id')->on('estudiante_curso')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('colegiaturas');
    }
};
