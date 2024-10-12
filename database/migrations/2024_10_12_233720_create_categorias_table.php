<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriasTable extends Migration
{
    public function up()
    {
        Schema::create('categorias', function (Blueprint $table) {
            $table->id();
            $table->enum('nombre', ['Tintes', 'Cabello', 'Barbería', 'Maquillaje', 'Accesorios', 'Uñas', 'Herramientas']);
            $table->text('descripcion')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('categorias');
    }
}
