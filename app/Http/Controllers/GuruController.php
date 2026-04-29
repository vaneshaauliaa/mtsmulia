<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use App\Models\guru;
use App\Models\Mengajar;
use App\Models\kelas;
use App\Models\mata_pelajaran;
use App\Models\membina;
use App\Models\ekstrakurikuler;
use App\Http\Requests\StoreguruRequest;
use App\Http\Requests\UpdateguruRequest;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

class GuruController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $guru = guru::with('jabatan')->get();
        return view('guru.index', compact('guru'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $jabatan = Jabatan::all();
        $kelas = kelas::all();
        $ekstrakurikuler = ekstrakurikuler::all();
        $mata_pelajaran = mata_pelajaran::all();
        return view('guru.create', compact('jabatan', 'kelas', 'mata_pelajaran', 'ekstrakurikuler'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreguruRequest $request)
    {
        try {
            DB::beginTransaction();
            
            $request->validate([
                'id_guru' => 'required|unique:guru,id_guru',
                'nama_guru' => 'required|max:255',
                'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
                'alamat' => 'required',
                'no_telp' => 'required|numeric|digits_between:10,13',
                'jabatan_id' => 'nullable|exists:jabatan,id',
            ]);

            // Simpan data guru
            $guru = Guru::create([
                'id_guru' => $request->id_guru,
                'nama_guru' => $request->nama_guru,
                'jenis_kelamin' => $request->jenis_kelamin,
                'alamat' => $request->alamat,
                'no_telp' => $request->no_telp,
                'jabatan_id' => $request->jabatan_id,
            ]);

            // Simpan data mengajar
            if ($request->has('mengajar')) {
                foreach ($request->mengajar as $item) {
                    if (!empty($item['id_mata_pelajaran']) && !empty($item['id_kelas'])) {
                        Mengajar::create([
                            'id_guru' => $guru->id_guru,
                            'id_mata_pelajaran' => $item['id_mata_pelajaran'],
                            'id_kelas' => $item['id_kelas'],
                        ]);
                    }
                }
            }

            // Simpan data membina ekstrakurikuler
            if ($request->has('membina')) {
                foreach ($request->membina as $item) {
                    if (!empty($item['id_ekstrakurikuler'])) {
                        membina::create([
                            'id_guru' => $guru->id_guru,
                            'id_ekstrakurikuler' => $item['id_ekstrakurikuler'],
                        ]);
                    }
                }
            }
            
            DB::commit();

            return redirect()->route('guru.index')->with([
                'success' => 'Data berhasil disimpan!'
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            
            return redirect()->route('guru.index')->with([
                'error' => 'Data gagal disimpan! Error: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(guru $guru)
    {
         $guru->load([
        'mengajar.mata_pelajaran', 
        'mengajar.kelas',
        'membina.ekstrakurikuler',
        'jabatan'
    ]);
    
    return view('guru.show', compact('guru'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(guru $guru): View
    {
        // Load relasi mengajar dan membina
        $guru->load(['mengajar', 'membina']);
        
        $jabatan = Jabatan::all();
        $kelas = kelas::all();
        $ekstrakurikuler = ekstrakurikuler::all();
        $mata_pelajaran = mata_pelajaran::all();
        
        return view('guru.edit', compact('guru', 'jabatan', 'kelas', 'mata_pelajaran', 'ekstrakurikuler'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateguruRequest $request, guru $guru)
    {
        try {
            DB::beginTransaction();
            
            $request->validate([
                'nama_guru' => 'required|max:255',
                'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
                'alamat' => 'required',
                'no_telp' => 'required|max:13',
                'jabatan_id' => 'nullable|exists:jabatan,id',
            ]);
            
            // Update data guru
            $guru->update([
                'nama_guru' => $request->nama_guru,
                'jenis_kelamin' => $request->jenis_kelamin,
                'no_telp' => $request->no_telp,
                'alamat' => $request->alamat,
                'jabatan_id' => $request->jabatan_id,
            ]);

            // Update data mengajar - hapus lalu insert ulang
            $guru->mengajar()->delete();
            if ($request->has('mengajar')) {
                foreach ($request->mengajar as $mengajar) {
                    if (!empty($mengajar['id_mata_pelajaran']) && !empty($mengajar['id_kelas'])) {
                        Mengajar::create([
                            'id_guru' => $guru->id_guru,
                            'id_mata_pelajaran' => $mengajar['id_mata_pelajaran'],
                            'id_kelas' => $mengajar['id_kelas'],
                        ]);
                    }
                }
            }

            // Update data membina - hapus lalu insert ulang
            $guru->membina()->delete();
            if ($request->has('membina')) {
                foreach ($request->membina as $membina_data) {
                    if (!empty($membina_data['id_ekstrakurikuler'])) {
                        membina::create([
                            'id_guru' => $guru->id_guru,
                            'id_ekstrakurikuler' => $membina_data['id_ekstrakurikuler'],
                        ]);
                    }
                }
            }

            DB::commit();
            
            return redirect()->route('guru.index')->with('success', 'Data berhasil diupdate!');
            
        } catch (\Exception $e) {
            DB::rollBack();
            
            return redirect()->route('guru.index')->with([
                'error' => 'Data gagal diupdate! Error: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(guru $guru)
    {
        try {
            DB::beginTransaction();
            
            // Hapus data mengajar dan membina terlebih dahulu
            $guru->mengajar()->delete();
            $guru->membina()->delete();
            
            // Hapus data guru
            $guru->delete();
            
            DB::commit();
            
            return redirect()->route('guru.index')->with('success', 'Data berhasil dihapus!');
            
        } catch (\Exception $e) {
            DB::rollBack();
            
            return redirect()->route('guru.index')->with([
                'error' => 'Data gagal dihapus! Error: ' . $e->getMessage()
            ]);
        }
    }
}