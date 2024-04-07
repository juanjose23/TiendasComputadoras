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
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('codigo')->nullable();
            $table->unsignedBigInteger('modelos_id')->references('id')->on('modelos')->cascadeOnDelete()->cascadeOnUpdate();
            $table->unsignedBigInteger('subcategorias_id')->references('id')->on('subcategorias')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('nombre');
            $table->text('descripcion')->nullable();
            $table->timestamp('fecha_lanzamiento')->nullable();
            $table->integer('estado');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
