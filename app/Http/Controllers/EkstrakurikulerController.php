<?php

namespace App\Http\Controllers;

use App\Models\ekstrakurikuler;
use App\Http\Requests\StoreekstrakurikulerRequest;
use App\Http\Requests\UpdateekstrakurikulerRequest;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class EkstrakurikulerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index():View
    {
        $ekstrakurikuler = ekstrakurikuler::all();
        return view('ekstrakurikuler.index', compact('ekstrakurikuler'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create():View
    {
        return view('ekstrakurikuler.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreekstrakurikulerRequest $request)
    {
        try {
            $request->validate([
                'id_ekstrakurikuler' => 'required|unique:ekstrakurikuler,id_ekstrakurikuler',
                'nama_ekstrakurikuler' => 'required|max:255',
            ]);

            // Simpan ke database
            ekstrakurikuler::create([
                'id_ekstrakurikuler' => $request->id_ekstrakurikuler,
                'nama_ekstrakurikuler'=> $request->nama_ekstrakurikuler,
            ]);

            return redirect()->route('ekstrakurikuler.index')->with([
                'success' => 'Data berhasil disimpan!'
            ]);

        } catch (\Exception $e) {

            return redirect()->route('ekstrakurikuler.index')->with([
                'error' => 'Data gagal disimpan!  Error: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(ekstrakurikuler $ekstrakurikuler)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ekstrakurikuler $ekstrakurikuler)
    {
        return view('ekstrakurikuler.edit', compact('ekstrakurikuler'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateekstrakurikulerRequest $request, ekstrakurikuler $ekstrakurikuler)
    {
        try {
            $request->validate([
                'id_ekstrakurikuler' => 'required|unique:ekstrakurikuler,id_ekstrakurikuler,' . $ekstrakurikuler->id,
                'nama_ekstrakurikuler' => 'required|max:255',
            ]);

            // Update ke database
            $ekstrakurikuler->update([
                'id_ekstrakurikuler' => $request->id_ekstrakurikuler,
                'nama_ekstrakurikuler'=> $request->nama_ekstrakurikuler,
            ]);

            return redirect()->route('ekstrakurikuler.index')->with([
                'success' => 'Data berhasil diupdate!'
            ]);

        } catch (\Exception $e) {

            return redirect()->route('ekstrakurikuler.index')->with([
                'error' => 'Data gagal diupdate!  Error: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ekstrakurikuler $ekstrakurikuler)
    {
        $ekstrakurikuler->delete();
        return redirect()->route('ekstrakurikuler.index')->with([
            'success' => 'Data berhasil dihapus!'
        ]);
    }
}
