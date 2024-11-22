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
        Schema::create('webinar', function (Blueprint $table) {
            $table->char('id', 36)->primary();
            $table->string('foto');
            $table->string('title');
            $table->string('subtitle');
            $table->string('tanggalMulai');
            $table->string('jamMulai');
            $table->enum('status', ['pendaftaran', 'berlangsung', 'selesai']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('webinar');
    }
};
