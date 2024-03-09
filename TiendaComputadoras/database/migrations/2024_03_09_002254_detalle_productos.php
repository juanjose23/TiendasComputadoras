<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('productos_detalles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('productos_id');
            $table->foreign('productos_id')->references('id')->on('productos');
            $table->string('dimensiones', 255)->nullable();
            $table->decimal('peso', 10, 2)->nullable();
            $table->string('material', 50)->nullable();
            $table->text('instrucciones_cuidado')->nullable();
            $table->text('instrucciones_montaje')->nullable();
            $table->text('caracteristicas_especiales')->nullable();
            $table->text('compatibilidad')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('productos_detalles');
    }
};
