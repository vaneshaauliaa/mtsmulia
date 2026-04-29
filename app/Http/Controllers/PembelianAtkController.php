<?php

namespace App\Http\Controllers;

use App\Models\pembelian_atk;
use App\Models\detail_pembelian_atk;
use App\Models\alat_tulis_kantor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PembelianAtkController extends Controller
{
    public function index()
    {
        $pembelian_atk = pembelian_atk::with('detailPembelianAtk.alatTulisKantor')
            ->latest('tanggal_pembelian')
            ->paginate(10);

        return view('pembelian_atk.index', compact('pembelian_atk'));
    }

    public function create()
    {
        $atk = alat_tulis_kantor::all();
        return view('pembelian_atk.create', compact('atk'));
    }

public function store(Request $request)
{
    $request->validate([
        'tanggal_pembelian' => 'required|date',
        'kode_pembelian'    => 'required|string|max:50|unique:pembelian_atk,kode_pembelian',
        'atk_id'            => 'required|array|min:1',
        'atk_id.*'          => 'required|exists:alat_tulis_kantor,id',
        'qty'               => 'required|array|min:1',
        'qty.*'             => 'required|integer|min:1',
        'harga'             => 'required|array|min:1',
        'harga.*'           => 'required|numeric|min:0',
        'satuan'            => 'required|array|min:1',
        'satuan.*'          => 'required|string|max:20',
        'bukti_pembelian'   => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
    ]);

    // Re-index arrays
    $atkIds  = array_values($request->atk_id);
    $qtys    = array_values($request->qty);
    $hargas  = array_values($request->harga);
    $satuans = array_values($request->satuan);

    // Hitung total
    $total = 0;
    foreach ($atkIds as $i => $atkId) {
        $total += $qtys[$i] * $hargas[$i];
    }

    // Handle upload bukti
    $buktiPembelianPath = null;
    if ($request->hasFile('bukti_pembelian')) {
        $buktiPembelianPath = $request->file('bukti_pembelian')
            ->store('bukti_pembelian', 'public');
    }

    DB::beginTransaction();
    try {
        // Simpan header
        $pembelian = pembelian_atk::create([
            'tanggal_pembelian' => $request->tanggal_pembelian,
            'kode_pembelian'    => $request->kode_pembelian,
            'total_harga'       => $total,
            'bukti_pembelian'   => $buktiPembelianPath,
        ]);

        // Simpan detail
        foreach ($atkIds as $i => $atkId) {
            detail_pembelian_atk::create([
                'pembelian_atk_id' => $pembelian->id,
                'atk_id'           => $atkId,
                'qty'              => $qtys[$i],
                'harga'            => $hargas[$i],
                'satuan'           => $satuans[$i],
                'subtotal'         => $qtys[$i] * $hargas[$i],
            ]);
        }

        DB::commit();

        return redirect()->route('pembelian_atk.index')
            ->with('success', 'Data pembelian ATK berhasil disimpan.');

    } catch (\Exception $e) {
        DB::rollBack();
        Log::error('Gagal menyimpan pembelian ATK: ' . $e->getMessage());
        return redirect()->back()
            ->withInput()
            ->with('error', 'Gagal menyimpan data: ' . $e->getMessage());
    }
}

    public function show(pembelian_atk $pembelian_atk)
    {
        $pembelian_atk->load('detailPembelianAtk.alatTulisKantor');
        return view('pembelian_atk.show', compact('pembelian_atk'));
    }   

    public function edit(pembelian_atk $pembelian_atk)
    {
        // Untuk sementara, fitur edit tidak diimplementasikan karena ini adalah transaksi pembelian yang biasanya tidak diubah setelah disimpan. 
        // Jika ingin menambahkan fitur edit, perlu dipertimbangkan bagaimana menangani perubahan pada detail pembelian 
        // (misalnya, jika jumlah atau harga diubah, bagaimana menghitung ulang total harga).
    }

    public function update(Request $request, pembelian_atk $pembelian_atk)
    {
        //
    }

    public function destroy(pembelian_atk $pembelian_atk)
    {
        // Untuk sementara, fitur delete tidak diimplementasikan karena ini adalah transaksi pembelian yang biasanya tidak dihapus setelah disimpan. 
        // Jika ingin menambahkan fitur delete, perlu dipertimbangkan bagaimana menangani data terkait 
        // (misalnya, detail pembelian) dan apakah ada aturan bisnis yang melarang penghapusan data
    }
}