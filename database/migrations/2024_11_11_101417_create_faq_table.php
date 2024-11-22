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
        Schema::create('faq', function (Blueprint $table) {
            $table->char('id', 36)->primary();

            $table->char('kategori_id', 36);
            $table->foreign('kategori_id')->references('id')->on('faqkategori');
            
            $table->string('pertanyaan');
            $table->string('jawaban');
            $table->integer('nilai');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('faq');
    }
};
