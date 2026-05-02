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
        Schema::table('jenis_pengeluaran', function (Blueprint $table) {
            $table->boolean('is_detail_khusus')->default(0)->after('nama_jenis_pengeluaran')->comment('0: Tampil di Biaya Operasional, 1: Transaksi Khusus (ATK/Gaji)');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('jenis_pengeluaran', function (Blueprint $table) {
            $table->dropColumn('is_detail_khusus');
        });
    }
};
