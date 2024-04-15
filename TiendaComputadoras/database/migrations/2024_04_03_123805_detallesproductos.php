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
        Schema::create("detallesproductos", function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("productos_id");
            $table->unsignedBigInteger("coloresproductos_id");
            $table->unsignedBigInteger("tallasproductos_id");
            $table->unsignedBigInteger("cortesproductos_id");
            $table->unsignedBigInteger("generos_id");
            $table->timestamps();
            $table->integer("estado");
            $table->foreign("productos_id")
                ->references("id")
                ->on("productos")
                ->onDelete("cascade")
                ->onUpdate("cascade");
            $table->foreign("coloresproductos_id")
                ->references("id")
                ->on("colores_productos")
                ->onDelete("cascade")
                ->onUpdate("cascade");

            $table->foreign("tallasproductos_id")
                ->references("id")
                ->on("tallasproductos")
                ->onDelete("cascade")
                ->onUpdate("cascade");

            $table->foreign("cortesproductos_id")
                ->references("id")
                ->on("cortesproductos")
                ->onDelete("cascade")
                ->onUpdate("cascade");

            $table->foreign("generos_id")
                ->references("id")
                ->on("generos")
                ->onDelete("cascade")
                ->onUpdate("cascade");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists("detallesproductos");
    }
};
