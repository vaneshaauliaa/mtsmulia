<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CoaController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\JenisPengeluaranController;
use App\Http\Controllers\SumberDanaController;
use App\Http\Controllers\MataPelajaranController;
use App\Http\Controllers\EkstrakurikulerController;
use App\Http\Controllers\PencatatanKasController;
use App\Http\Controllers\PengajuanKasKeluarController;
use App\Http\Controllers\PerhitunganGajiGuruController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\PengaturanHonorController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AlatTulisKantorController;
use App\Http\Controllers\PembelianAtkController;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard');

//master data
Route::resource('/coa', App\Http\Controllers\CoaController::class);
Route::resource('/guru', App\Http\Controllers\GuruController::class);
Route::resource('/jenis_pengeluaran', App\Http\Controllers\JenisPengeluaranController::class);
Route::resource('/sumber_dana', App\Http\Controllers\SumberDanaController::class);
Route::resource('/mata_pelajaran', App\Http\Controllers\MataPelajaranController::class);
Route::resource('/ekstrakurikuler', App\Http\Controllers\EkstrakurikulerController::class);
Route::resource('/jabatan', App\Http\Controllers\JabatanController::class);
Route::resource('/pengaturan_honor', App\Http\Controllers\PengaturanHonorController::class);
Route::resource('/alat_tulis_kantor', App\Http\Controllers\AlatTulisKantorController::class);

//transaksi
Route::resource('/pencatatan_kas', PencatatanKasController::class);
Route::resource('/pengajuan_kas_keluar', PengajuanKasKeluarController::class);
Route::resource('/perhitungan_gaji_guru', PerhitunganGajiGuruController::class);
Route::resource('/pembelian_atk', PembelianAtkController::class);
Route::resource('/pemasukan_dana', App\Http\Controllers\PemasukanDanaController::class);


//laporan
Route::prefix('laporan')->group(function () {
    Route::get('/kas_masuk', [LaporanController::class, 'kasMasuk'])->name('laporan.kas_masuk');
    Route::get('/kas_keluar', [LaporanController::class, 'kasKeluar'])->name('laporan.kas_keluar');
    Route::get('/jurnal', [LaporanController::class, 'jurnal'])->name('laporan.jurnal');
    Route::get('/buku_besar', [LaporanController::class, 'bukuBesar'])->name('laporan.buku_besar');
});
