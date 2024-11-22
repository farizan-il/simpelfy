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
        Schema::create('ModulHasMidTest', function (Blueprint $table) {
            $table->char('id', 36)->primary();
            $table->char('id_modul', 36);
            $table->foreign('id_modul')->references('id')->on('modul');

            $table->enum('type', ['pre-test', 'mid-test', 'post-test']);
            $table->integer('duration');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ModulHasMidTest');
    }
};
