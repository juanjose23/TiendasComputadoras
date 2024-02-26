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
        Schema::create('proveedores', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_personas')->unique();
            $table->enum('sector_comercial', ['Electrónicos', 'Tecnología', 'Informática', 'Telecomunicaciones', 'Otro'])->nullable(false);
            $table->unsignedBigInteger('pais_id')->nullable();
            $table->tinyInteger('estado')->nullable(false)->default(1);
            $table->timestamps();

            // Definición de las restricciones de clave externa
            $table->foreign('pais_id')->references('id')->on('pais')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_personas')->references('id')->on('personas')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proveedores');
    }
};
