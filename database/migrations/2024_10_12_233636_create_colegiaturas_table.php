<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('colegiaturas', function (Blueprint $table) {
            $table->id('ID_Colegiatura');
            $table->unsignedBigInteger('id_estudiante_curso');
            $table->integer('semana')->nullable();
            $table->boolean('Asistio');
            $table->date('Fecha_de_Pago')->nullable();
            $table->enum('estado', ['pendiente', 'pagado']);
            $table->decimal('Monto', 10)->nullable();
            $table->foreign('id_estudiante_curso')->references('id')->on('estudiante_curso')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('colegiaturas');
    }
};
