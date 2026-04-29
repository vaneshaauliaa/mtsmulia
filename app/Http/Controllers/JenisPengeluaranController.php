<?php

namespace App\Http\Controllers;

use App\Models\jenis_pengeluaran;
use App\Http\Requests\Storejenis_pengeluaranRequest;
use App\Http\Requests\Updatejenis_pengeluaranRequest;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class JenisPengeluaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $jenis_pengeluaran = jenis_pengeluaran::all();
        return view('jenis_pengeluaran.index', compact('jenis_pengeluaran'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('jenis_pengeluaran.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Storejenis_pengeluaranRequest $request)
    {
        try {
            $request->validate([
                'id_jenis_pengeluaran' => 'required|unique:jenis_pengeluaran,id_jenis_pengeluaran',
                'nama_jenis_pengeluaran' => 'required',
            ]);

            // Simpan ke database
            jenis_pengeluaran::create([
                'id_jenis_pengeluaran' => $request->id_jenis_pengeluaran,
                'nama_jenis_pengeluaran' => $request->nama_jenis_pengeluaran,
            ]);

            return redirect()->route('jenis_pengeluaran.index')->with([
                'success' => 'Data berhasil disimpan!'
            ]);

        } catch (\Exception $e) {

            return redirect()->route('jenis_pengeluaran.index')->with([
                'error' => 'Data gagal disimpan!  Error: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(jenis_pengeluaran $jenis_pengeluaran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(jenis_pengeluaran $jenis_pengeluaran)
    {
        return view('jenis_pengeluaran.edit', compact('jenis_pengeluaran'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Updatejenis_pengeluaranRequest $request, jenis_pengeluaran $jenis_pengeluaran)
    {
        try {
            $request->validate([
                'id_jenis_pengeluaran' => 'required|unique:jenis_pengeluaran,id_jenis_pengeluaran,' . $jenis_pengeluaran->id,
                'nama_jenis_pengeluaran' => 'required',
            ]);

            // Update ke database
            $jenis_pengeluaran->update([
                'id_jenis_pengeluaran' => $request->id_jenis_pengeluaran,
                'nama_jenis_pengeluaran' => $request->nama_jenis_pengeluaran,
            ]);

            return redirect()->route('jenis_pengeluaran.index')->with([
                'success' => 'Data berhasil diupdate!'
            ]);

        } catch (\Exception $e) {

            return redirect()->route('jenis_pengeluaran.index')->with([
                'error' => 'Data gagal diupdate!  Error: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(jenis_pengeluaran $jenis_pengeluaran)
    {
        $jenis_pengeluaran->delete();
        return redirect()->route('jenis_pengeluaran.index')->with('success', 'Data berhasil dihapus!');
    }
}
