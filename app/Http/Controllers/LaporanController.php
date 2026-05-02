<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\pencatatan_kas;
use App\Models\sumber_dana;
use App\Models\biaya_operasional;
use App\Models\pembelian_atk;
use App\Models\perhitungan_gaji_guru;
use App\Models\jenis_pengeluaran;
use Carbon\Carbon;


class LaporanController extends Controller
{
    /**
     * =========================
     * LAPORAN KAS MASUK
     * =========================
     */
    public function kasMasuk(Request $request)
{
    $kasMasuk = DB::table('pemasukan_dana')
        ->leftJoin('sumber_dana', 'pemasukan_dana.sumber_dana_id', '=', 'sumber_dana.id')
        ->select(
            'pemasukan_dana.tanggal',
            'pemasukan_dana.keterangan',
            'sumber_dana.nama_sumber_dana',
            'pemasukan_dana.jumlah'
        )
        ->orderBy('pemasukan_dana.tanggal', 'asc')
        ->get();

    $total = $kasMasuk->sum('jumlah');

    return view('laporan.kas_masuk.index', compact('kasMasuk', 'total'));
}


    /**
     * =========================
     * LAPORAN KAS KELUAR
     * Menggabungkan 3 sumber: Biaya Operasional, Pembelian ATK, Gaji Guru
     * =========================
     */

    public function kasKeluar(Request $request)
    {
        $bulan = $request->filled('bulan') ? (int) $request->bulan : null;
        $tahun = $request->filled('tahun') ? (int) $request->tahun : null;

        // -------------------------------------------
        // 1. BIAYA OPERASIONAL
        // -------------------------------------------
        $queryBiaya = biaya_operasional::with('jenis_pengeluaran');
        if ($bulan) {
            $queryBiaya->whereMonth('tanggal', $bulan);
        }
        if ($tahun) {
            $queryBiaya->whereYear('tanggal', $tahun);
        }
        $biayaOperasional = $queryBiaya->get()->map(function ($item) {
            return [
                'source'           => 'biaya_operasional',
                'id'               => $item->id,
                'tanggal'          => $item->tanggal,
                'tanggal_sort'     => $item->tanggal,
                'jenis_pengeluaran'=> $item->jenis_pengeluaran->nama_jenis_pengeluaran ?? 'Biaya Operasional',
                'nama_pengeluaran' => $item->keterangan ?? '-',
                'jumlah'           => $item->total,
                // data detail untuk modal
                'kode_transaksi'   => $item->kode_transaksi,
                'nomor_nota'       => $item->nomor_nota,
                'keterangan'       => $item->keterangan,
                'bukti'            => $item->bukti_transaksi,
            ];
        });

        // -------------------------------------------
        // 2. PEMBELIAN ATK
        // -------------------------------------------
        $queryAtk = pembelian_atk::with('detailPembelianAtk.alatTulisKantor');
        if ($bulan) {
            $queryAtk->whereMonth('tanggal_pembelian', $bulan);
        }
        if ($tahun) {
            $queryAtk->whereYear('tanggal_pembelian', $tahun);
        }
        $pembelianAtk = $queryAtk->get()->map(function ($item) {
            return [
                'source'           => 'pembelian_atk',
                'id'               => $item->id,
                'tanggal'          => $item->tanggal_pembelian,
                'tanggal_sort'     => $item->tanggal_pembelian,
                'jenis_pengeluaran'=> 'Pembelian ATK',
                'nama_pengeluaran' => $item->kode_pembelian ?? 'Pembelian ATK',
                'jumlah'           => $item->total_harga,
                // data detail untuk modal
                'kode_pembelian'   => $item->kode_pembelian,
                'bukti'            => $item->bukti_pembelian,
                'detail_items'     => $item->detailPembelianAtk->map(function ($d) {
                    return [
                        'nama_atk' => $d->alatTulisKantor->nama_atk ?? '-',
                        'qty'      => $d->qty,
                        'satuan'   => $d->satuan,
                        'harga'    => $d->harga,
                        'subtotal' => $d->subtotal,
                    ];
                })->toArray(),
            ];
        });

        // -------------------------------------------
        // 3. PERHITUNGAN GAJI GURU (grouped per bulan + tahun)
        // -------------------------------------------
        $queryGaji = perhitungan_gaji_guru::with(['guru', 'jenisPengeluaran']);
        if ($bulan) {
            $queryGaji->where('bulan', $bulan);
        }
        if ($tahun) {
            $queryGaji->where('tahun', $tahun);
        }

        $bulanNames = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret',
            4 => 'April',   5 => 'Mei',       6 => 'Juni',
            7 => 'Juli',    8 => 'Agustus',   9 => 'September',
            10 => 'Oktober', 11 => 'November', 12 => 'Desember',
        ];

        // Group per bulan+tahun
        $gajiRaw     = $queryGaji->get();
        $gajiGrouped = $gajiRaw->groupBy(function ($item) {
            return $item->bulan . '_' . $item->tahun;
        });

        // Detail per guru per bulan-tahun (untuk modal list)
        $gajiGuruDetails = [];
        $gajiGuru        = collect();

        foreach ($gajiGrouped as $key => $group) {
            $first           = $group->first();
            $namaBulan       = $bulanNames[$first->bulan] ?? $first->bulan;
            $totalGaji       = $group->sum('total_gaji');
            $tanggalSort     = Carbon::createFromDate($first->tahun, $first->bulan, 1)->toDateString();
            $jenisPengeluaran = $first->jenisPengeluaran->nama_jenis_pengeluaran ?? 'Gaji Guru';

            // Simpan detail list guru untuk modal
            $gajiGuruDetails[$key] = $group->map(function ($item) {
                return [
                    'id'         => $item->id,
                    'nama_guru'  => $item->guru->nama_guru ?? 'Guru',
                    'tanggal'    => $item->created_at
                                        ? $item->created_at->format('d-m-Y')
                                        : '-',
                    'total_gaji' => $item->total_gaji,
                ];
            })->values()->toArray();

            $gajiGuru->push([
                'source'            => 'gaji_guru_group',
                'id'                => $key,           // "bulan_tahun" sebagai key unik
                'tanggal'           => $namaBulan . ' ' . $first->tahun,
                'tanggal_sort'      => $tanggalSort,
                'jenis_pengeluaran' => $jenisPengeluaran,
                'nama_pengeluaran'  => 'Gaji Guru Bulan ' . $namaBulan . ' ' . $first->tahun,
                'jumlah'            => $totalGaji,
                // info tambahan untuk header modal
                'bulan_nama'        => $namaBulan,
                'tahun'             => $first->tahun,
                'bulan_tahun_key'   => $key,
                'jumlah_guru'       => $group->count(),
            ]);
        }

        // -------------------------------------------
        // Gabungkan & urutkan terbaru ke terlama
        // -------------------------------------------
        $kasKeluar = $biayaOperasional
            ->merge($pembelianAtk)
            ->merge($gajiGuru)
            ->sortByDesc('tanggal_sort')
            ->values();

        $total = $kasKeluar->sum('jumlah');

        return view('laporan.kas_keluar.index', compact('kasKeluar', 'total', 'gajiGuruDetails'));
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
