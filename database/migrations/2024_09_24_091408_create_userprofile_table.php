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

        Schema::create('userprofile', function (Blueprint $table) {
            $table->char('id', 36)->primary();
            $table->char('user_credentials_id', 36);
            $table->foreign('user_credentials_id')->references('id')->on('usercredentials');
            $table->char('role_id', 36)->default('20f735d1-4c17-11ef-9334-c8a7edad9afe');
            $table->foreign('role_id')->references('id')->on('UserRole');
            $table->string('nama', 255);
            $table->enum('jenisKelamin', ["Laki-laki", "Perempuan"]);
            $table->string('fotoProfile');
            $table->string('nomorHandphone');
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('userprofile');
    }
};
