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
        Schema::create('persona_juridicas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('personas_id');
            $table->date('fecha_constitucional');
            $table->string('numero_ruc', 18)->unique()->nullable(false);
            $table->string('razon_social', 250)->nullable();
            $table->timestamps();
            $table->foreign('personas_id')->references('id')->on('personas')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('persona__juridicas');
    }
};
