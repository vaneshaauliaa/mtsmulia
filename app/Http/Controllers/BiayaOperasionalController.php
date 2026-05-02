<?php

namespace App\Http\Controllers;

use App\Models\biaya_operasional;
use App\Models\jenis_pengeluaran;
use Illuminate\Http\Request;

class BiayaOperasionalController extends Controller
{
    public function index(Request $request)
    {
        $biayaOperasional = biaya_operasional::with('jenis_pengeluaran')->get();
        $query = biaya_operasional::with('jenis_pengeluaran');
        
        if ($request->jenis_filter) {
            $query->where('id_jenis_pengeluaran', $request->jenis_filter);
            }

        if ($request->bulan_filter) {
            $query->whereMonth('tanggal', $request->bulan_filter);
        }

        if ($request->tahun_filter) {
            $query->whereYear('tanggal', $request->tahun_filter);
        }

        $biayaOperasional = $query->latest()->get();

        return view('biaya_operasional.index', compact('biayaOperasional'));

    }

    public function create()
    {
        $jenisPengeluaran = jenis_pengeluaran::where('is_detail_khusus', 0)->get();
        // Generate kode transaksi format BOP-YYYYMMDD-XXX
        $today = now()->format('Ymd');
        $lastTransaction = biaya_operasional::whereDate('created_at', now()->toDateString())->orderBy('id', 'desc')->first();
        if ($lastTransaction) {
            $lastCode = explode('-', $lastTransaction->kode_transaksi);
            $lastNumber = (int) end($lastCode);
            $newNumber = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
            $kodeTransaksi = 'BOP-' . $today . '-' . $newNumber;
        } else {
            $kodeTransaksi = 'BOP-' . $today . '-001';
        }

        return view('biaya_operasional.create', compact('jenisPengeluaran', 'kodeTransaksi'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'tanggal' => 'required|date',
            'kode_transaksi' => 'required|string|unique:biaya_operasional,kode_transaksi',
            'nomor_nota' => 'nullable|string|max:255',
            'jenis_pengeluaran_id' => 'required|exists:jenis_pengeluaran,id',
            'total' => 'required|numeric',
            'keterangan' => 'nullable|string',
            'bukti_transaksi' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        if ($request->hasFile('bukti_transaksi')) {
            $validatedData['bukti_transaksi'] = $request->file('bukti_transaksi')->store('bukti_transaksi', 'public');
        }

        biaya_operasional::create($validatedData);

        return redirect()->route('biaya_operasional.index')->with('success', 'Biaya Operasional berhasil ditambahkan.');
    }

    public function show($id)
    {
        $biaya_operasional = biaya_operasional::with('jenis_pengeluaran')->findOrFail($id);
        return view('biaya_operasional.show', compact('biaya_operasional'));
    }
}
