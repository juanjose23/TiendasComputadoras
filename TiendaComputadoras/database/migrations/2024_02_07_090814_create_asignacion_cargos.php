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
        Schema::create('asignacion_cargos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cargos_id');
            $table->unsignedBigInteger('empleados_id');
            $table->date('fecha_registro')->nullable();
            $table->tinyInteger('estado')->nullable(false)->default(1);
            $table->timestamps();

            // Definición de las restricciones de clave externa
            $table->foreign('cargos_id')->references('id')->on('cargos')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('empleados_id')->references('id')->on('empleados')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asignacion_cargos');
    }
};
