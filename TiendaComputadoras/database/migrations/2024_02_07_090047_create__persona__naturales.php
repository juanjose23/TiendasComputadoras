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
        Schema::create('persona_naturales', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('personas_id');
            $table->unsignedBigInteger('paises_id');
            $table->unsignedBigInteger('generos_id');
            $table->string('apellido', 80);
            $table->string('tipo_identificacion',50);
            $table->string('identificacion', 25);
            $table->date('fecha_nacimiento')->nullable();
            $table->timestamps();
            $table->foreign('personas_id')->references('id')->on('personas')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('paises_id')->references('id')->on('pais')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('generos_id')->references('id')->on('generos')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('persona__naturales');
    }
};
