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
        //
        Schema::create('colores_productos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('productos_id');
            $table->foreign('productos_id')->references('id')->on('productos');
            $table->unsignedBigInteger('colores_id');
            $table->foreign('colores_id')->references('id')->on('colores');
            $table->integer('estado');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('colores_productos');
    }
};
