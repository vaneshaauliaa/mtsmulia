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
        Schema::create('perhitungan_gaji_guru', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_guru')->constrained('guru')->onDelete('cascade');
            $table->foreignId('id_jenis_pengeluaran')->constrained('jenis_pengeluaran')->onDelete('cascade');
            $table->integer('bulan');
            $table->integer('tahun');
            $table->integer('total_jam_mengajar');
            $table->integer('honor_mengajar')->default(0);
            $table->integer('honor_ekstrakurikuler')->default(0);
            $table->integer('honor_jabatan')->default(0);
            $table->integer('total_gaji');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perhitungan_gaji_guru');
    }
};
