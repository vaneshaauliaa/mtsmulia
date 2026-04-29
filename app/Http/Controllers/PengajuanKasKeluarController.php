<?php

namespace App\Http\Controllers;

use App\Models\jenis_pengeluaran;
use App\Models\pengajuan_kas_keluar;
use App\Http\Requests\Storepengajuan_kas_keluarRequest;
use App\Http\Requests\Updatepengajuan_kas_keluarRequest;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class PengajuanKasKeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = pengajuan_kas_keluar::with('jenis_pengeluaran')
        ->orderBy('tanggal_pengajuan','desc')->get();
        
        return view('pengajuan_kas_keluar.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $jenis_pengeluaran = jenis_pengeluaran::all();
        return view('pengajuan_kas_keluar.create', compact('jenis_pengeluaran'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Storepengajuan_kas_keluarRequest $request)
    {
        $request->validate([
        'tanggal_pengajuan' => 'required|date',
        'jenis_pengeluaran_id' => 'required|exists:jenis_pengeluaran,id',
        'jumlah_pengajuan' => 'required|numeric',
        'keterangan' => 'nullable|string',
        'berkas_pengajuan' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

         if ($request->hasFile('bukti_transaksi')) {
            $file = $request->file('bukti_transaksi');
            $path = $file->store('bukti_transaksi', 'public');
        } else {
            $path = null;
            }

        pengajuan_kas_keluar::create([
        'tanggal_pengajuan' => $request->tanggal_pengajuan,
        'jenis_pengeluaran_id' => $request->jenis_pengeluaran_id,
        'jumlah_pengajuan' => $request->jumlah_pengajuan,
        'keterangan' => $request->keterangan,
        'status' => 'pending',
        'berkas_pengajuan' => $path,
        ]);

        return redirect()->route('pengajuan_kas_keluar.index')
                         ->with('success', 'Pengajuan kas keluar berhasil dibuat dan sedang dalam status pending.');
    }

    /**
     * Display the specified resource.
     */
    public function show ($id)// (pengajuan_kas_keluar $pengajuan_kas_keluar): View
    {
         $pengajuan = pengajuan_kas_keluar::with('jenis_pengeluaran')
                  ->findOrFail($id);
                  
        return view('pengajuan_kas_keluar.show', compact('pengajuan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(pengajuan_kas_keluar $pengajuan_kas_keluar)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Updatepengajuan_kas_keluarRequest $request, pengajuan_kas_keluar $pengajuan_kas_keluar)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(pengajuan_kas_keluar $pengajuan_kas_keluar)
    {
        //
    }
}
