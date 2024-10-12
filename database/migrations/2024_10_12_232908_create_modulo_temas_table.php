<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('modulo_temas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_modulo');
            $table->unsignedBigInteger('id_tema');
            $table->foreign('id_modulo')->references('id')->on('modulos')->onDelete('cascade');
            $table->foreign('id_tema')->references('id')->on('temas')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('modulo_temas');
    }
};
