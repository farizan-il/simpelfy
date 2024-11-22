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
        Schema::create('Tests', function (Blueprint $table) {
            $table->char('id', 36)->primary();
            $table->char('kelas_id', 36)->nullable();;
            $table->foreign('kelas_id')->references('id')->on('kelas');

            $table->uuid('modul_id')->nullable();
            $table->foreign('modul_id')->references('id')->on('modul')->onDelete('cascade');

            $table->enum('type', ['pre-test', 'mid-test', 'post-test']);
            $table->integer('duration');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Tests');
    }
};
