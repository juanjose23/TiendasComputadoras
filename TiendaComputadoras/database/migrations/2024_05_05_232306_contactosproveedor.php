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
        Schema::create('contactosproveedores', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('personas_id')->unique();
            $table->unsignedBigInteger('proveedores_id')->unique();
            $table->unsignedBigInteger('pais_id')->nullable();
            $table->string('cargo')->nullable();
            $table->tinyInteger('estado')->nullable(false)->default(1);
            $table->timestamps();

            // Definición de las restricciones de clave externa
            $table->foreign('pais_id')->references('id')->on('pais')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('personas_id')->references('id')->on('personas')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('proveedores_id')->references('id')->on('proveedores')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
