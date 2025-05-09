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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('personas_id');
            $table->string('provider')->nullable();
            $table->string('provider_id')->nullable();
            $table->string('usuario')->unique();
            $table->string('password');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('token_login')->nullable();
            $table->rememberToken();
            $table->integer('estado');
            $table->timestamps();
            $table->foreign('personas_id')->references('id')->on('personas')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
