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
        Schema::create('pencatatan_kas', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->enum('jenis_transaksi', ['kas_masuk', 'kas_keluar']);
            $table->foreignId('sumber_dana_id')->nullable()->constrained('sumber_dana')->onDelete('cascade');
            $table->foreignId('jenis_pengeluaran_id')->nullable()->constrained('jenis_pengeluaran')->onDelete('cascade');
            $table->integer('jumlah');
            $table->text('keterangan')->nullable();
            $table->string('bukti_transaksi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pencatatan_kas');
    }
};
