<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('servicios', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->text('descripcion')->nullable();
            $table->decimal('precio', 10);
            $table->enum('categoria', ['manicura', 'color', 'corte y estilizado', 'alisado y tratamiento', 'cejas y pestañas', 'maquillaje y peinado', 'pedicura']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('servicios');
    }
};
