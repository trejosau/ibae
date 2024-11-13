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
        Schema::create('personas', function (Blueprint $table) { // Especifica el nombre de la tabla si no sigue la convención de plural
            $table->id();
            $table->string('nombre', 30)->nullable();
            $table->string('ap_paterno', 30)->nullable();
            $table->string('ap_materno', 30)->nullable();
            $table->string('telefono', 15)->nullable();
            $table->foreignId('usuario')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personas');
    }
};
