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
        Schema::create('VoucherKelas', function (Blueprint $table) {
            $table->char('id', 36)->primary();
            $table->string('kodeVoucher')->unique();
            $table->integer('jumlahVoucher');
            $table->integer('potonganHarga');
            $table->date('start_date');
            $table->date('end_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('VoucherKelas');
    }
};
