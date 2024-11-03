<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('modulos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->enum('categoria', ['Barberia', 'Belleza']);
            $table->integer('duracion');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('modulos');
    }
};
