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
        Schema::create('usercredentials', function (Blueprint $table) {
            $table->char('id', 36)->primary();
            $table->string('username', 255);
            $table->string('email', 255);
            $table->string('password', 255);
            $table->boolean('isLocked')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usercredentials');
    }
};
