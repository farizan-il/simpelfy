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
        Schema::create('UserHasWebinar', function (Blueprint $table) {
            $table->char('id', 36)->primary();
            $table->char('user_credentials_id', 36);
            $table->foreign('user_credentials_id')->references('id')->on('UserCredentials');

            $table->char('user_has_webinar_id', 36);
            $table->foreign('user_has_webinar_id')->references('id')->on('Webinar');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('UserHasWebinar');
    }
};
