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
        Schema::disableForeignKeyConstraints();

        Schema::create('faq', function (Blueprint $table) {
            $table->char('id', 36)->primary();
            $table->char('user_credentials_id', 36);
            $table->foreign('user_credentials_id')->references('id')->on('usercredentials');
            $table->char('faq_category_id', 36);
            $table->foreign('faq_category_id')->references('id')->on('faq_category');
            $table->string('pertanyaan', 255);
            $table->text('jawaban');
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('faq');
    }
};
