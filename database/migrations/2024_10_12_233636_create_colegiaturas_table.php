<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateColegiaturasTable extends Migration
{
    public function up()
    {
        Schema::create('colegiaturas', function (Blueprint $table) {
            $table->id('ID_Colegiatura');
            $table->unsignedBigInteger('id_estudiante_curso');
            $table->integer('semana')->nullable();
            $table->boolean('Asistio');
            $table->date('Fecha_de_Pago')->nullable();
            $table->enum('estado', ['activo', 'inactivo']);
            $table->decimal('Monto', 10, 2)->nullable();
            $table->foreign('id_estudiante_curso')->references('id')->on('estudiante_curso')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('colegiaturas');
    }
}
