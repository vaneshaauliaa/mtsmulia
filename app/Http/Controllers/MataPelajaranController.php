<?php

namespace App\Http\Controllers;

use App\Models\mata_pelajaran;
use App\Http\Requests\Storemata_pelajaranRequest;
use App\Http\Requests\Updatemata_pelajaranRequest;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;


class MataPelajaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mata_pelajaran = mata_pelajaran::all();
        return view('mata_pelajaran.index', compact('mata_pelajaran'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('mata_pelajaran.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Storemata_pelajaranRequest $request)
    {
        try {
            $request->validate([
                'id_mata_pelajaran' => 'required|unique:mata_pelajaran,id_mata_pelajaran',
                'nama_mata_pelajaran' => 'required|max:255',
            ]);

            // Simpan ke database
            Mata_pelajaran::create([
                'id_mata_pelajaran' => $request->id_mata_pelajaran,
                'nama_mata_pelajaran'=> $request->nama_mata_pelajaran,
            ]);

            return redirect()->route('mata_pelajaran.index')->with([
                'success' => 'Data berhasil disimpan!'
            ]);

        } catch (\Exception $e) {

            return redirect()->route('mata_pelajaran.index')->with([
                'error' => 'Data gagal disimpan!  Error: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(mata_pelajaran $mata_pelajaran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(mata_pelajaran $mata_pelajaran)
    {
        return view('mata_pelajaran.edit', compact('mata_pelajaran'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Updatemata_pelajaranRequest $request, mata_pelajaran $mata_pelajaran)
    {
        try {
            $request->validate([
                'id_mata_pelajaran' => 'required|unique:mata_pelajaran,id_mata_pelajaran,' . $mata_pelajaran->id,
                'nama_mata_pelajaran' => 'required|max:255',
            ]);

            // Update ke database
            $mata_pelajaran->update([
                'id_mata_pelajaran' => $request->id_mata_pelajaran,
                'nama_mata_pelajaran'=> $request->nama_mata_pelajaran,
            ]);

            return redirect()->route('mata_pelajaran.index')->with([
                'success' => 'Data berhasil diupdate!'
            ]);

        } catch (\Exception $e) {

            return redirect()->route('mata_pelajaran.index')->with([
                'error' => 'Data gagal diupdate!  Error: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(mata_pelajaran $mata_pelajaran)
    {
        $mata_pelajaran->delete();
        return redirect()->route('mata_pelajaran.index')->with([
            'success' => 'Data berhasil dihapus!'
        ]);
    }
}
