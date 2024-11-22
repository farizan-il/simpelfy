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
        Schema::create('artikelhasbeenread', function (Blueprint $table) {
            $table->char('id', 36)->primary();
            $table->char('user_credentials_id', 36);
            $table->char('artikel_id', 36);
            $table->tinyInteger('rating');
            $table->timestamps();

            // Add foreign key constraints if necessary
            $table->foreign('user_credentials_id')->references('id')->on('UserCredentials');
            $table->foreign('artikel_id')->references('id')->on('artikel');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('artikelhasbeenread');
    }
};
