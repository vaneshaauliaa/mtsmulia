<?php

namespace App\Http\Controllers;

use App\Models\pemasukan_dana;
use App\Models\sumber_dana;
use App\Http\Requests\Storepemasukan_danaRequest;
use App\Http\Requests\Updatepemasukan_danaRequest;

class PemasukanDanaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pemasukanDana = pemasukan_dana::with('sumberDana')->get();
        $sumberDana = sumber_dana::all();
        return view('pemasukan_dana.index', compact('pemasukanDana', 'sumberDana'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sumberDana = sumber_dana::all();
        return view('pemasukan_dana.create', compact('sumberDana'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Storepemasukan_danaRequest $request)
    {
        $validatedData = $request->validate([
            'tanggal' => 'required|date',
            'kode_transaksi' => 'required|string|unique:pemasukan_dana,kode_transaksi',
            'sumber_dana_id' => 'required|exists:sumber_dana,id',
            'jumlah' => 'required|numeric',
            'keterangan' => 'nullable|string',
            'bukti_transaksi' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        if ($request->hasFile('bukti_transaksi')) {
            $validatedData['bukti_transaksi'] = $request->file('bukti_transaksi')->store('bukti_transaksi', 'public');
        }

        pemasukan_dana::create($validatedData);

        return redirect()->route('pemasukan_dana.index')->with('success', 'Pemasukan dana berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(pemasukan_dana $pemasukan_dana)
    {
        $pemasukan_dana->load('sumberDana');
        return view('pemasukan_dana.show', compact('pemasukan_dana'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(pemasukan_dana $pemasukan_dana)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Updatepemasukan_danaRequest $request, pemasukan_dana $pemasukan_dana)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(pemasukan_dana $pemasukan_dana)
    {
        //
    }
}
