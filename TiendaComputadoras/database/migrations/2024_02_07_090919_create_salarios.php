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
        Schema::create('salarios', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('empleados_id');
            $table->decimal('salario', 10, 2);
            $table->tinyInteger('estado')->nullable(false)->default(1);
            $table->timestamps();

            // Definición de la restricción de clave externa
            $table->foreign('empleados_id')->references('id')->on('empleados')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('salarios');
    }
};
