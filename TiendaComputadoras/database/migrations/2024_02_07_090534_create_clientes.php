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
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('personas_id')->unique();
            $table->enum('tipo_cliente', ['Individual', 'Corporativo', 'VIP', 'Preferencial'])->nullable(false);
            $table->tinyInteger('estado')->nullable(false)->default(1);
            $table->timestamps();
            $table->foreign('personas_id')->references('id')->on('personas')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};
