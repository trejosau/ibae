<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('profesores', function (Blueprint $table) {
            $table->id(); // Crea la columna id como clave primaria
            $table->enum('especialidad', ['estilismo', 'barbería', 'maquillaje', 'uñas']);
            $table->date('fecha_contratacion');
            $table->string('RFC', 13)->unique();
            $table->string('CURP', 18)->unique();
            $table->enum('estado', ['activo', 'inactivo', 'vacaciones']);
            $table->unsignedBigInteger('id_persona');
            $table->string('zipcode', 10);
            $table->string('ciudad', 100);
            $table->string('colonia', 100);
            $table->string('calle', 100);
            $table->string('n_ext', 10);
            $table->string('n_int', 10)->nullable();
            $table->foreign('id_persona')->references('id')->on('personas')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profesores');
    }
};
