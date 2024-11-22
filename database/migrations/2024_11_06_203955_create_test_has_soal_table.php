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
        Schema::create('TestHasSoal', function (Blueprint $table) {
            $table->char('id', 36)->primary();
            
            $table->char('test_id', 36);
            $table->foreign('test_id')->references('id')->on('Tests');

            $table->text('questionText');
            $table->json('options');
            $table->string('correctAnswer');
            $table->text('explanation')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('TestHasSoal');
    }
};
