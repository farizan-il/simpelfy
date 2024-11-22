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
        Schema::create('UserHasProgress', function (Blueprint $table) {
            $table->char('id', 36)->primary();

            $table->char('modul_detail_id', 36);
            $table->foreign('modul_detail_id')->references('id')->on('detail_modul');

            $table->uuid('test_id')->nullable();
            $table->foreign('test_id')->references('id')->on('Tests')->onDelete('cascade');

            $table->char('orders_id', 36);
            $table->foreign('orders_id')->references('id')->on('Orders');

            $table->char('user_credentials_id', 36);
            $table->foreign('user_credentials_id')->references('id')->on('UserCredentials');

            $table->enum('status',  ["proses", "selesai"]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('UserHasProgress');
    }
};
