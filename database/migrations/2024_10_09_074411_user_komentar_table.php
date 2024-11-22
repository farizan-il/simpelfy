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
        Schema::create('userkomentar', function (Blueprint $table) {
            $table->char('id', 36)->primary();
            $table->char('user_credentials_id', 36);
            $table->foreign('user_credentials_id')->references('id')->on('usercredentials');
            
            $table->char('kelas_id', 36);
            $table->foreign('kelas_id')->references('id')->on('kelas');
            
            $table->text('komentartext');
            $table->tinyInteger('rating')->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('userkomentar');
    }
};
