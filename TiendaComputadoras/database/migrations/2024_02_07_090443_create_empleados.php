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
        Schema::create('empleados', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('personas_id');
            $table->unsignedBigInteger('estado_civiles_id');
            $table->string('codigo', 30)->nullable(false);
            $table->string('codigo_inss', 20)->unique()->nullable();
            $table->tinyInteger('estado')->nullable(false)->default(1);
            $table->timestamps();

            // Definición de las restricciones de clave externa
            $table->foreign('estado_civiles_id')->references('id')->on('estado_civiles')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('personas_id')->references('id')->on('personas')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empleados');
    }
};
