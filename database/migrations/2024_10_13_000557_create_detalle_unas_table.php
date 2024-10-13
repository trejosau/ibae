<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('detalle_unas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_detalle_cita');
            $table->integer('largo')->check('largo BETWEEN 1 AND 8');
            $table->integer('cantidad_piedras')->default(0);
            $table->integer('cantidad_cristales')->default(0);
            $table->integer('cantidad_stickers')->default(0);
            $table->integer('cantidad_efecto_foil')->default(0);
            $table->integer('cantidad_efecto_espejo')->default(0);
            $table->integer('cantidad_efecto_azucar')->default(0);
            $table->integer('cantidad_efecto_mano_alzada')->default(0);
            $table->integer('cantidad_efecto_3d')->default(0);
            $table->foreign('id_detalle_cita')->references('id')->on('detalle_cita')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('detalle_unas');
    }
};
