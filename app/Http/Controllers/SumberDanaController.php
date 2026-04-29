<?php

namespace App\Http\Controllers;

use App\Models\sumber_dana;
use App\Http\Requests\Storesumber_danaRequest;
use App\Http\Requests\Updatesumber_danaRequest;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;


class SumberDanaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $sumber_dana = sumber_dana::all();
        return view('sumber_dana.index', compact('sumber_dana'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('sumber_dana.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Storesumber_danaRequest $request)
    {
        try{
            $request->validate([
                'id_sumber_dana' => 'required|unique:sumber_dana,id_sumber_dana',
                'nama_sumber_dana' => 'required',
            ]);

            // Simpan ke database
            sumber_dana::create([
                'id_sumber_dana' => $request->id_sumber_dana,
                'nama_sumber_dana' => $request->nama_sumber_dana,
            ]);

            return redirect()->route('sumber_dana.index')->with([
                'success' => 'Data berhasil disimpan!'
            ]);

        } catch (\Exception $e) {

            return redirect()->route('sumber_dana.index')->with([
                'error' => 'Data gagal disimpan!  Error: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(sumber_dana $sumber_dana)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(sumber_dana $sumber_dana)
    {
        return view('sumber_dana.edit', compact('sumber_dana'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Updatesumber_danaRequest $request, sumber_dana $sumber_dana) 
    {
        try {
            
            $request->validate([
                'id_sumber_dana' => 'required|unique:sumber_dana,id_sumber_dana,' . $sumber_dana->id,
                'nama_sumber_dana' => 'required',
            ]);

            // Update ke database
            $sumber_dana->update([
                'id_sumber_dana' => $request->id_sumber_dana,
                'nama_sumber_dana' => $request->nama_sumber_dana,
            ]);

            return redirect()->route('sumber_dana.index')->with([
                'success' => 'Data berhasil diupdate!'
            ]);

        } catch (\Exception $e) {

            return redirect()->route('sumber_dana.index')->with([
                'error' => 'Data gagal diupdate!  Error: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(sumber_dana $sumber_dana)
    {
        $sumber_dana->delete();
        return redirect()->route('sumber_dana.index')->with('success', 'Data berhasil dihapus!');
    }
}
