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
       

        // Creación de la tabla lote
        Schema::create('lote', function (Blueprint $table) {
            $table->id();
            $table->string('numero_lote', 50)->notNull();
            $table->unsignedBigInteger('empleados_id');
            $table->foreign('empleados_id')->references('id')->on('empleados');
            $table->foreignId('proveedores_id')->nullable()->constrained('proveedores')->onDelete('cascade');
            $table->decimal('subtotal');
            $table->decimal('iva');
            $table->decimal('total');
            $table->integer('estado')->default(1);
            $table->timestamps();

           
            $table->index('proveedores_id');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
       
        Schema::dropIfExists('lote');
       
    }

};
