<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('proveedores', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_persona');
            $table->string('nombre_empresa');
            $table->string('contacto_telefono', 15);
            $table->string('contacto_correo');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('proveedores');
    }
};
