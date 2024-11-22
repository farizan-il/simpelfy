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

        Schema::create('UserRole', function (Blueprint $table) {
            $table->char('id', 36)->primary();
            $table->string('roleName', 355)->comment('SuperAdmin ,  Admin ,  Instruktur ,  Pelanggan');
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('UserRole');
    }
};
