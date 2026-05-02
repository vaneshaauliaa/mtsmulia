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
        Schema::create('biaya_operasional', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->string('kode_transaksi');
            $table->string('nomor_nota')->nullable();
            $table->foreignId('jenis_pengeluaran_id')->constrained('jenis_pengeluaran');
            $table->text('keterangan')->nullable();
            $table->decimal('total', 15, 2);
            $table->string('bukti_transaksi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('biaya_operasional');
    }
};
