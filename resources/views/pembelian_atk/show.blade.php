@extends('layouts.app')

@section('title', 'Detail Pembelian ATK')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span>Detail Pembelian ATK</span>
            <a href="{{ route('pembelian_atk.index') }}" class="btn btn-sm btn-outline-secondary">Kembali</a>
        </div>
        <div class="card-body">

            {{-- Info Header --}}
            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Tanggal Pembelian</label>
                    <input type="text" class="form-control" value="{{ \Carbon\Carbon::parse($pembelian_atk->tanggal_pembelian)->format('d M Y') }}" readonly>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Kode Transaksi</label>
                    <input type="text" class="form-control" value="{{ $pembelian_atk->kode_pembelian }}" readonly>
                </div>
            </div>

            {{-- Bukti Pembelian --}}
            @if($pembelian_atk->bukti_pembelian)
            <div class="mb-3">
                <label class="form-label fw-semibold">Bukti Pembelian</label>
                <div>
                    @php
                        $ext = pathinfo($pembelian_atk->bukti_pembelian, PATHINFO_EXTENSION);
                    @endphp

                    @if(in_array(strtolower($ext), ['jpg', 'jpeg', 'png']))
                        <img src="{{ asset('storage/' . $pembelian_atk->bukti_pembelian) }}"
                             alt="Bukti Pembelian"
                             class="img-fluid rounded border"
                             style="max-height: 300px;">
                    @elseif(strtolower($ext) === 'pdf')
                        <a href="{{ asset('storage/' . $pembelian_atk->bukti_pembelian) }}"
                           target="_blank" class="btn btn-sm btn-outline-danger">
                            <i class="bi bi-file-earmark-pdf"></i> Lihat PDF
                        </a>
                    @endif
                </div>
            </div>
            @else
            <div class="mb-3">
                <label class="form-label fw-semibold">Bukti Pembelian</label>
                <p class="text-muted fst-italic">Tidak ada bukti pembelian.</p>
            </div>
            @endif

            <hr>
            <h5>Detail ATK</h5>

            <table class="table table-bordered table-hover">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Nama ATK</th>
                        <th>Satuan</th>
                        <th>Qty</th>
                        <th>Harga Satuan</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pembelian_atk->detailPembelianAtk as $i => $detail)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>{{ $detail->alatTulisKantor->nama_atk }}</td>
                        <td>{{ ucfirst($detail->satuan) }}</td>
                        <td>{{ $detail->qty }}</td>
                        <td>Rp {{ number_format($detail->harga, 0, ',', '.') }}</td>
                        <td>Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">Tidak ada detail ATK.</td>
                    </tr>
                    @endforelse
                </tbody>
                <tfoot>
                    <tr class="fw-bold table-light">
                        <td colspan="5" class="text-end">Total Harga:</td>
                        <td>Rp {{ number_format($pembelian_atk->total_harga, 0, ',', '.') }}</td>
                    </tr>
                </tfoot>
            </table>

        </div>
    </div>
</div>
@endsection