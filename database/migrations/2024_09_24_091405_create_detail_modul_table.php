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

        Schema::create('detail_modul', function (Blueprint $table) {
            $table->char('id', 36)->primary();
            $table->char('id_modul', 36);
            $table->foreign('id_modul')->references('id')->on('modul');
            $table->string('file', 255);
            $table->string('detailModul', 255);
            $table->integer('duration');
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_modul');
    }
};
