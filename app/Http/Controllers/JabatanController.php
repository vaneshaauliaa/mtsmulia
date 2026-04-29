<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class JabatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $jabatan = Jabatan::orderBy('nama_jabatan', 'asc')->get();
        return view('jabatan.index', compact('jabatan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('jabatan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        try {
            $validated = $request->validate([
                'nama_jabatan' => 'required|string|max:255',
                'honor_jabatan' => 'required|numeric|min:0',
            ], [
                'nama_jabatan.required' => 'Nama jabatan wajib diisi!',
                'nama_jabatan.max' => 'Nama jabatan maksimal 255 karakter!',
                'honor_jabatan.required' => 'Tunjangan jabatan wajib diisi!',
                'honor_jabatan.numeric' => 'Tunjangan jabatan harus berupa angka!',
                'honor_jabatan.min' => 'Tunjangan jabatan tidak boleh negatif!',
            ]);

            Jabatan::create($validated);

            return redirect()->route('jabatan.index')->with('success', 'Data jabatan berhasil ditambahkan!');

        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput();
                
        } catch (\Exception $e) {
            return redirect()->route('jabatan.index')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Jabatan $jabatan): View
    {
        return view('jabatan.show', compact('jabatan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Jabatan $jabatan): View
    {
        return view('jabatan.edit', compact('jabatan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Jabatan $jabatan): RedirectResponse
    {
        try {
            $validated = $request->validate([
                'nama_jabatan' => 'required|string|max:255',
                'honor_jabatan' => 'required|numeric|min:0',
            ], [
                'nama_jabatan.required' => 'Nama jabatan wajib diisi!',
                'nama_jabatan.max' => 'Nama jabatan maksimal 255 karakter!',
                'honor_jabatan.required' => 'Tunjangan jabatan wajib diisi!',
                'honor_jabatan.numeric' => 'Tunjangan jabatan harus berupa angka!',
                'honor_jabatan.min' => 'Tunjangan jabatan tidak boleh negatif!',
            ]);

            $jabatan->update($validated);

            return redirect()->route('jabatan.index')->with('success', 'Data jabatan berhasil diperbarui!');

        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput();
                
        } catch (\Exception $e) {
            return redirect()->route('jabatan.index')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jabatan $jabatan): RedirectResponse
    {
        try {
            $namaJabatan = $jabatan->nama_jabatan;
            $jabatan->delete();

            return redirect()->route('jabatan.index')->with('success', "Data jabatan '{$namaJabatan}' berhasil dihapus!");

        } catch (\Exception $e) {
            return redirect()->route('jabatan.index')->with('error', 'Terjadi kesalahan saat menghapus data: ' . $e->getMessage());
        }
    }
}