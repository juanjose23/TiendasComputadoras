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
        Schema::create("tallasproductos", function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("tallas_id");
            $table->unsignedBigInteger("productos_id");
            $table->timestamps();
            $table->integer("estado");

            $table->foreign("tallas_id")
                ->references("id")
                ->on("tallas")
                ->onDelete("cascade")
                ->onUpdate("cascade");

            $table->foreign("productos_id")
                ->references("id")
                ->on("productos")
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
        Schema::dropIfExists("tallasproductos");
    }
};
