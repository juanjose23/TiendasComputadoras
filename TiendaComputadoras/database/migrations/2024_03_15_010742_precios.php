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
        Schema::create('precios', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('productoscolores_id');
            $table->foreign('productoscolores_id')->references('id')->on('colores_productos');
            $table->decimal('precio',10,2);
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
        Schema::dropIfExists('precios');
    }
};
