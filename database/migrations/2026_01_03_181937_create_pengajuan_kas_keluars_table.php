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
        Schema::create('pengajuan_kas_keluar', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_pengajuan');
            $table->unsignedBigInteger('jenis_pengeluaran_id');
            $table->decimal('jumlah_pengajuan', 15, 2);
            $table->text('keterangan')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->foreign('jenis_pengeluaran_id')->references('id')->on('jenis_pengeluaran')->onDelete('cascade');
            $table->string('berkas_pengajuan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuan_kas_keluar');
    }
};
