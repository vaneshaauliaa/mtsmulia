<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\pencatatan_kas;
use App\Models\sumber_dana;
use App\Models\jenis_transaksi_pengeluaran;


class LaporanController extends Controller
{
    /**
     * =========================
     * LAPORAN KAS MASUK
     * =========================
     */
    public function kasMasuk(Request $request)
{
    $kasMasuk = DB::table('pencatatan_kas')
        ->leftJoin('sumber_dana', 'pencatatan_kas.sumber_dana_id', '=', 'sumber_dana.id')
        ->select(
            'pencatatan_kas.tanggal',
            'pencatatan_kas.keterangan',
            'sumber_dana.nama_sumber_dana',
            'pencatatan_kas.jumlah'
        )
        ->where('pencatatan_kas.jenis_transaksi', 'kas_masuk')
        ->orderBy('pencatatan_kas.tanggal', 'asc')
        ->get();

    $total = $kasMasuk->sum('jumlah');

    return view('laporan.kas_masuk.index', compact('kasMasuk', 'total'));
}


    /**
     * =========================
     * LAPORAN KAS KELUAR
     * =========================
     */

public function kasKeluar(Request $request)
{
    $query = DB::table('pencatatan_kas')
        ->leftJoin('jenis_pengeluaran', 'pencatatan_kas.jenis_pengeluaran_id', '=', 'jenis_pengeluaran.id')
        ->select(
            'pencatatan_kas.tanggal',
            'pencatatan_kas.keterangan',
            'jenis_pengeluaran.nama_jenis_pengeluaran',
            'pencatatan_kas.jumlah'
        )
        ->where('pencatatan_kas.jenis_transaksi', 'kas_keluar');

    // filter bulan
    if ($request->filled('bulan')) {
        $query->whereMonth('pencatatan_kas.tanggal', $request->bulan);
    }

    // filter tahun
    if ($request->filled('tahun')) {
        $query->whereYear('pencatatan_kas.tanggal', $request->tahun);
    }

    $kasKeluar = $query
        ->orderBy('pencatatan_kas.tanggal', 'asc')
        ->get();

    $total = $kasKeluar->sum('jumlah');

   return view('laporan.kas_keluar.index', compact('kasKeluar', 'total'));
}

    /** 
     * =========================
     * JURNAL UMUM
     * (placeholder dulu)
     * =========================
     */
    public function jurnal(Request $request)
    {
        return view('laporan.jurnal.index');
    }

    /**
     * =========================
     * BUKU BESAR
     * (placeholder dulu)
     * =========================
     */
    public function bukuBesar(Request $request)
    {
        return view('laporan.buku_besar.index');
    }
}
