<?php

namespace App\Http\Controllers;

use App\Models\coa;
use App\Http\Requests\StorecoaRequest;
use App\Http\Requests\UpdatecoaRequest;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class CoaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $coa = coa::all();
        return view('coa.index', compact('coa'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('coa.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorecoaRequest $request)
    {
        try {
            $request->validate([
                'kode_akun' => 'required|unique:coa,kode_akun',
                'nama_akun' => 'required|max:255',
                'header_akun' => 'required',
                'saldo_awal' => 'required',
            ]);

            // Simpan ke database
            Coa::create([
                'kode_akun'   => $request->kode_akun,
                'nama_akun'   => $request->nama_akun,
                'header_akun' => $request->header_akun,
                'saldo_awal'  => $request->saldo_awal,
            ]);

            return redirect()->route('coa.index')->with([
                'success' => 'Data berhasil disimpan!'
            ]);

        } catch (\Exception $e) {

            return redirect()->route('coa.index')->with([
                'error' => 'Data gagal disimpan!  Error: ' . $e->getMessage()
            ]);

        }
    } // ← INI penting! Penutup fungsi store()

    /**
     * Display the specified resource.
     */
    public function show(coa $coa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(coa $coa)
    {
        return view('coa.edit', compact('coa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatecoaRequest $request, coa $coa)
    {
        request()->validate([
            'kode_akun' => 'required|unique:coa,kode_akun,' . $coa->id,
            'nama_akun' => 'required|max:255',
            'header_akun' => 'required',
            'saldo_awal' => 'required',
        ]);
        $coa->update($request->all());
        return redirect()->route('coa.index')->with('success', 'Data berhasil diupdate!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(coa $coa): RedirectResponse
    {
        $coa = coa::findOrFail($coa->id);
        $coa->delete();
        return redirect()->route('coa.index')->with('success', 'Data berhasil dihapus!');
    }
}
