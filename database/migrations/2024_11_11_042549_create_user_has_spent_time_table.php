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
        Schema::create('UserHasSpentTime', function (Blueprint $table) {
            $table->char('id', 36)->primary();

            $table->char('user_has_progress_id', 36);
            $table->foreign('user_has_progress_id')->references('id')->on('UserHasProgress');

            $table->integer('spentTime')->default(0);
            $table->enum('type',  ["video", "test"]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('UserHasSpentTime');
    }
};
