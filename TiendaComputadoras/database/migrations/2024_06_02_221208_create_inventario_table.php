<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Creación de la tabla movimiento
        Schema::create('movimiento', function (Blueprint $table) {
            $table->id();
            $table->enum('tipo', ['Entrada', 'Salida','Devolución de compra','Devolución de venta'])->notNull();
          
            $table->text('descripcion')->nullable();
            $table->timestamps();
        });


        // Creación de la tabla lote
        Schema::create('lote', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('productosdetalles_id');
            $table->foreign('productosdetalles_id')->references('id')->on('detallesproductos');
            $table->string('numero_lote', 50)->notNull();
            $table->date('fecha_vencimiento')->nullable();
            $table->integer('cantidad')->unsigned()->notNull();
            $table->foreignId('movimiento_id')->nullable()->constrained('movimiento')->onDelete('cascade');
            $table->integer('estado')->default(1);
            $table->timestamps();

            // Índices para mejorar el rendimiento en consultas
            $table->index('productosdetalles_id');
            $table->index('movimiento_id');
        });


        // Creación de la tabla inventario
        Schema::create('inventario', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lote_id');
            $table->foreign('lote_id')->references('id')->on('lote')->onDelete('cascade');
            $table->integer('cantidad')->unsigned()->notNull();
            $table->integer('stock_maximo')->unsigned()->notNull();
            $table->integer('stock_minimo')->unsigned()->notNull();
            $table->timestamps();

            // Índice para mejorar el rendimiento en consultas
            $table->index('lote_id');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventario');
        Schema::dropIfExists('lote');
        Schema::dropIfExists('movimiento');
    }

};
