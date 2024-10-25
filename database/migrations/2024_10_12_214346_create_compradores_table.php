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
        Schema::create('compradores', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_persona');
            $table->enum('preferencia', ['barber', 'belleza']);
            $table->foreign('id_persona')->references('id')->on('personas')->onDelete('cascade');
            $table->string('razon_social', 100)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('compradores');
    }
};
