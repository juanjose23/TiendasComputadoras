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
        Schema::create('detalle_solicitud_compra', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('solicitud_compras_id');
            $table->foreign('solicitud_compras_id')->references('id')->on('solicitud_compra');
            $table->unsignedBigInteger('productosdetalles_id');
            $table->foreign('productosdetalles_id')->references('id')->on('detallesproductos');
            $table->integer('cantidad');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalle_solicitud_compra');
    }
};
