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

        Schema::create('kelas', function (Blueprint $table) {
            $table->char('id', 36)->primary();
            $table->char('id_kategori', 36);
            $table->foreign('id_kategori')->references('id')->on('kategori');
            $table->string('title', 255);
            $table->string('subtitle', 255);
            $table->integer('harga');
            $table->text('deskripsi');
            $table->string('foto', 255)->default('image-kelas-default');
            $table->string('keuntungan', 255);
            $table->string('syarat', 255);
            $table->string('instruktur', 255);
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kelas');
    }
};
