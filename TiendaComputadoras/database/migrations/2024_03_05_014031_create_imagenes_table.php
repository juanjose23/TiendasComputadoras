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
        Schema::create('imagenes', function (Blueprint $table) {
            $table->id();
            $table->string('url');
            $table->string('public_id')->nullable();
            $table->morphs('imagenable');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('imagenes');
    }
};
