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
       
        Schema::create('detalles_lotes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lotes_id');
            $table->foreign('lotes_id')->references('id')->on('lote');
            $table->unsignedBigInteger('productosdetalles_id');
            $table->foreign('productosdetalles_id')->references('id')->on('detallesproductos');
            $table->integer('cantidad')->unsigned()->notNull();
            $table->integer('precio')->unsigned()->notNull();
            $table->timestamps();
            $table->index('productosdetalles_id');
            $table->index('lotes_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalles_lotes');
    }
};
