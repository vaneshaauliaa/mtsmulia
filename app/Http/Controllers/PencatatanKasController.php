<?php

namespace App\Http\Controllers;

use App\Models\pencatatan_kas;
use App\Models\sumber_dana;
use App\Models\jenis_pengeluaran;
use App\Http\Requests\Storepencatatan_kasRequest;
use App\Http\Requests\Updatepencatatan_kasRequest;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class PencatatanKasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = pencatatan_kas::with(['sumberDana', 'jenisPengeluaran'])
        ->orderBy('tanggal', 'desc')
        ->get();
        
        return view('pencatatan_kas.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $sumber_dana = \App\Models\sumber_dana::all();
        $jenis_pengeluaran = \App\Models\jenis_pengeluaran::all();

        return view('pencatatan_kas.create', compact('sumber_dana', 'jenis_pengeluaran'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Storepencatatan_kasRequest $request)
    {
         $request->validate([
        'tanggal' => 'required|date',
        'jenis_transaksi' => 'required',
        'sumber_dana_id' => 'nullable|exists:sumber_dana,id',
        'jenis_pengeluaran_id' => 'nullable|exists:jenis_pengeluaran,id',
        'jumlah' => 'required|numeric',
        'keterangan' => 'nullable|string',
        'bukti_transaksi' => 'nullable|file |mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('bukti_transaksi')) {
            $file = $request->file('bukti_transaksi');
            $path = $file->store('bukti_transaksi', 'public');
        } else {
            $path = null;
            }

        pencatatan_kas::create([
        'tanggal' => $request->tanggal,
        'jenis_transaksi' => $request->jenis_transaksi,
        'sumber_dana_id' => $request->sumber_dana_id,
        'jenis_pengeluaran_id' => $request->jenis_pengeluaran_id,
        'jumlah' => $request->jumlah,
        'keterangan' => $request->keterangan,
        'bukti_transaksi' => $path,
        ]);
        
        
        return redirect()
        ->route('pencatatan_kas.index')
        ->with('success', 'Data pencatatan kas berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $pencatatan = pencatatan_kas::with(['sumberDana', 'jenisPengeluaran'])
        ->findOrFail($id);
        return view('pencatatan_kas.show', compact('pencatatan')); 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(pencatatan_kas $pencatatan_kas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Updatepencatatan_kasRequest $request, pencatatan_kas $pencatatan_kas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(pencatatan_kas $pencatatan_kas)
    {
        //
    }
}
