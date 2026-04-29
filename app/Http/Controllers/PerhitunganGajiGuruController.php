<?php

namespace App\Http\Controllers;

use App\Models\perhitungan_gaji_guru;
use App\Models\jenis_pengeluaran;
use App\Models\pencatatan_kas;
use App\Models\guru;
use App\Models\pengaturan_honor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class PerhitunganGajiGuruController extends Controller
{
    public function index(): View
    {
        $data = perhitungan_gaji_guru::with([
            'guru.mengajar.mata_pelajaran',
            'guru.mengajar.kelas',
            'guru.membina.ekstrakurikuler'
        ])
        ->orderBy('tahun', 'desc')
        ->orderBy('bulan', 'desc')
        ->get();

        return view('perhitungan_gaji_guru.index', compact('data'));
    }

    public function create(Request $request): View
    {
        $guruList = guru::all();

        $honorMengajarPerJam = pengaturan_honor::where('nama_honor', 'Honor Mengajar')
            ->value('jumlah_honor') ?? 0;

        $honorEkstrakurikulerSetting = pengaturan_honor::where('nama_honor', 'Honor Ekstrakurikuler')
            ->value('jumlah_honor') ?? 0;

        $guru = null;
        $totalJam = 0;
        $totalHonorMengajar = 0;
        $honorEskul = 0;
        $honorJabatan = 0;
        $totalHonor = 0;

        if ($request->id_guru) {
            $guru = guru::with([
                'mengajar.mata_pelajaran',
                'mengajar.kelas',
                'jabatan',
                'membina'
            ])->where('id_guru', $request->id_guru)->first();

            if ($guru) {
                foreach ($guru->mengajar as $m) {
                    $totalJam += $m->mata_pelajaran->jumlah_jam ?? 0;
                }

                $totalHonorMengajar = $totalJam * $honorMengajarPerJam;
                $honorEskul = $guru->membina->count() > 0 ? $honorEkstrakurikulerSetting : 0;
                $honorJabatan = $guru->jabatan->honor_jabatan ?? 0;
                $totalHonor = $totalHonorMengajar + $honorEskul + $honorJabatan;
            }
        }

        return view('perhitungan_gaji_guru.create', compact(
            'guruList',
            'guru',
            'totalJam',
            'honorMengajarPerJam',
            'totalHonorMengajar',
            'honorEskul',
            'honorJabatan',
            'totalHonor'
        ));
    }

    /**
 * Display the specified resource.
 */
public function show($id): View
{
    $data = perhitungan_gaji_guru::with([
        'guru.mengajar.mata_pelajaran',
        'guru.mengajar.kelas',
        'guru.jabatan',
        'guru.membina.ekstrakurikuler'
    ])->findOrFail($id);

    return view('perhitungan_gaji_guru.show', compact('data'));
}

   public function store(Request $request)
{
    $request->validate([
        'id_guru' => 'required|exists:guru,id_guru',
        'bulan' => 'required|integer|min:1|max:12',
        'tahun' => 'required|integer|min:2000',
    ]);

    DB::beginTransaction();
    try {
        $guru = guru::with(['mengajar.mata_pelajaran', 'jabatan', 'membina'])
            ->where('id_guru', $request->id_guru)
            ->firstOrFail();

        $honorMengajarPerJam = pengaturan_honor::where('nama_honor', 'Honor Mengajar')
            ->value('jumlah_honor') ?? 0;

        $honorEskulSetting = pengaturan_honor::where('nama_honor', 'Honor Ekstrakurikuler')
            ->value('jumlah_honor') ?? 0;

        $totalJam = 0;
        foreach ($guru->mengajar as $m) {
            $totalJam += $m->mata_pelajaran->jumlah_jam ?? 0;
        }

        $honorMengajar = $totalJam * $honorMengajarPerJam;
        $honorEskul = $guru->membina->count() > 0 ? $honorEskulSetting : 0;
        $honorJabatan = $guru->jabatan->honor_jabatan ?? 0;
        $totalHonor = $honorMengajar + $honorEskul + $honorJabatan;
        $jenisPengeluaran = jenis_pengeluaran::where(
            'nama_jenis_pengeluaran',
            'Honor Guru dan Ekstrakurikuler'
            )->firstOrFail();

        perhitungan_gaji_guru::create([
            'id_guru' => $guru->id,
            'id_jenis_pengeluaran' => $jenisPengeluaran->id,
            'bulan' => $request->bulan,
            'tahun' => $request->tahun,
            'total_jam_mengajar' => $totalJam,
            'honor_mengajar' => $honorMengajar,
            'honor_ekstrakurikuler' => $honorEskul,
            'honor_jabatan' => $honorJabatan,
            'total_gaji' => $totalHonor,
        ]);

        DB::commit();

        return redirect()
            ->route('perhitungan_gaji_guru.index')
            ->with('success', 'Gaji guru berhasil disimpan');

    } catch (\Exception $e) {
        DB::rollback();
        dd($e->getMessage()); // kalau masih error, ini error ASLI
    }
}


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
       //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }
}