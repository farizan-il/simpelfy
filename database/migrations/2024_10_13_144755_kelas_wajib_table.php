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
        Schema::create('kelaswajib', function (Blueprint $table) {
            $table->char('id', 36)->primary();

            $table->char('kelas_id', 36);
            $table->foreign('kelas_id')->references('id')->on('kelas');

            $table->char('departement_id', 36);
            $table->foreign('departement_id')->references('id')->on('departement');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kelaswajib');
    }
};
