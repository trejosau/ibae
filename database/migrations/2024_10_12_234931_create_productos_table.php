<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->text('descripcion')->nullable();
            $table->string('marca', 100);
            $table->decimal('precio_lista', 10);
            $table->decimal('precio_venta', 10);
            $table->integer('cantidad');
            $table->enum('medida', ['pzas', 'ml', 'lt', 'gr', 'cm']);
            $table->unsignedBigInteger('id_proveedor');
            $table->string('main_photo')->nullable();
            $table->integer('stock');
            $table->enum('estado', ['activo', 'inactivo', 'agotado']);
            $table->date('fecha_agregado');
            $table->unsignedBigInteger('id_categoria');
            $table->foreign('id_proveedor')->references('id')->on('proveedores')->onDelete('cascade');
            $table->foreign('id_categoria')->references('id')->on('categorias')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
