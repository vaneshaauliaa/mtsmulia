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
        Schema::create('pemasukan_dana', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->string('kode_transaksi')->unique();
            $table->foreignId('sumber_dana_id')->constrained('sumber_dana');
            $table->decimal('jumlah', 15, 2);
            $table->string('keterangan')->nullable();
            $table->string('bukti_transaksi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemasukan_dana');
    }
};
