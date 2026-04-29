<?php

namespace App\Http\Controllers;

use App\Models\alat_tulis_kantor;
use App\Http\Requests\Storealat_tulis_kantorRequest;
use App\Http\Requests\Updatealat_tulis_kantorRequest;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Redirect;


class AlatTulisKantorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $atk = alat_tulis_kantor::all();
        return view('alat_tulis_kantor.index', compact('atk'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
{
    $lastAtk = alat_tulis_kantor::orderBy('id', 'desc')->first();

    if ($lastAtk) {
        $lastNumber = (int) substr($lastAtk->kode_atk, 4); // ambil angka setelah ATK-
        $newNumber = $lastNumber + 1;
    } else {
        $newNumber = 1;
    }

    $kodeAtk = 'ATK-' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);

    return view('alat_tulis_kantor.create', compact('kodeAtk'));
}
    

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
    alat_tulis_kantor::create([
        'kode_atk' => $request->kode_atk,
        'nama_atk' => $request->nama_atk,
    ]);

    return redirect()->route('alat_tulis_kantor.index')
                     ->with('success', 'Data ATK berhasil ditambahkan');
                     }
    /*public function store(Storealat_tulis_kantorRequest $request)
    {
        $validated = $request->validate([
            'kode_atk' => 'required|string|max:255',
            'nama_atk' => 'required|string|max:255',
        ], [
            'kode_atk.required' => 'Kode ATK wajib diisi!',
            'kode_atk.max' => 'Kode ATK maksimal 255 karakter!',
            'nama_atk.required' => 'Nama ATK wajib diisi!',
            'nama_atk.max' => 'Nama ATK maksimal 255 karakter!',
        ]);

        alat_tulis_kantor::create($validated);

        return redirect()->route('alat_tulis_kantor.index')->with('success', 'Data alat tulis kantor berhasil ditambahkan!');
    }*/

    /**
     * Display the specified resource.
     */
    public function show(alat_tulis_kantor $alat_tulis_kantor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(alat_tulis_kantor $alat_tulis_kantor)
    {
        $atk = alat_tulis_kantor::findOrFail($alat_tulis_kantor->id);
        return view('alat_tulis_kantor.edit', compact('atk'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    $request->validate([
        'nama_atk' => 'required|string|max:255',
    ]);

    $atk = alat_tulis_kantor::findOrFail($id);

    $atk->update([
        'nama_atk' => $request->nama_atk,
    ]);

    return redirect()->route('alat_tulis_kantor.index')
                     ->with('success', 'Data ATK berhasil diperbarui');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(alat_tulis_kantor $alat_tulis_kantor)
    {
        $alat_tulis_kantor->delete();
        return redirect()->route('alat_tulis_kantor.index')->with('success', 'Data alat tulis kantor berhasil dihapus!');
    }
}
