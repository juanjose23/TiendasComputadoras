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
            $table->unsignedBigInteger('personas_id')->unique();
            $table->enum('sector_comercial', ['Hombre', 'Mujer', 'Niños', 'Bebés', 'Deportes', 'Accesorios', 'Otro'])->nullable(false);
            $table->unsignedBigInteger('paises_id')->nullable();
            $table->string('telefono')->nullable();
            $table->text('descripcion')->nullable();
            $table->tinyInteger('estado')->nullable(false)->default(1);
            $table->timestamps();

            // Definición de las restricciones de clave externa
            $table->foreign('paises_id')->references('id')->on('pais')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('personas_id')->references('id')->on('personas')->onDelete('cascade')->onUpdate('cascade');
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
