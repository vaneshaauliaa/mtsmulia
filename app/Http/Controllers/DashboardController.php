<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\perhitungan_gaji_guru;

class DashboardController extends Controller
{
    public function index()
    {
        // Total seluruh gaji guru
        $totalGajiGuru = perhitungan_gaji_guru::sum('total_gaji');

        // Total kas masuk
        $totalKasMasuk = DB::table('pencatatan_kas')
            ->where('jenis_transaksi', 'kas_masuk')
            ->sum('jumlah');

        // Total kas keluar
        $totalKasKeluar = DB::table('pencatatan_kas')
            ->where('jenis_transaksi', 'kas_keluar')
            ->sum('jumlah');

        return view('dashboard', compact(
            'totalGajiGuru',
            'totalKasMasuk',
            'totalKasKeluar'
        ));
    }
}
