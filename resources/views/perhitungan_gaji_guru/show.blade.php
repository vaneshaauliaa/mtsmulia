@extends('layouts.app')

@section('title', 'Detail Perhitungan Gaji Guru')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-semibold mb-0">Detail Perhitungan Gaji Guru</h4>
        <a href="{{ route('perhitungan_gaji_guru.index') }}" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="row">
        {{-- CARD INFO GURU & PERIODE --}}
        <div class="col-lg-4 mb-4">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="bi bi-person-circle"></i> Informasi Guru</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="text-muted small mb-1">NIP</label>
                        <div class="fw-semibold fs-5">{{ $data->guru->id_guru ?? '-' }}</div>
                    </div>

                    <div class="mb-3">
                        <label class="text-muted small mb-1">Nama Guru</label>
                        <div class="fw-semibold fs-5">{{ $data->guru->nama_guru ?? '-' }}</div>
                    </div>

                    <div class="mb-3">
                        <label class="text-muted small mb-1">Jabatan</label>
                        <div>
                            @if($data->guru && $data->guru->jabatan)
                                <span class="badge bg-success px-3 py-2">
                                    <i class="bi bi-award"></i> {{ $data->guru->jabatan->nama_jabatan }}
                                </span>
                            @else
                                <span class="badge bg-secondary px-3 py-2">Tidak ada jabatan</span>
                            @endif
                        </div>
                    </div>

                    <hr>

                    <div class="mb-3">
                        <label class="text-muted small mb-1">Periode Gaji</label>
                        <div class="fw-semibold">
                            @php
                                $bulanNama = [
                                    1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
                                    5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
                                    9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
                                ];
                            @endphp
                            <span class="badge bg-info text-dark fs-6 px-3 py-2">
                                <i class="bi bi-calendar-event"></i> 
                                {{ $bulanNama[$data->bulan] ?? '-' }} {{ $data->tahun }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- CARD RINCIAN GAJI --}}
        <div class="col-lg-8">
            {{-- DATA MENGAJAR --}}
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0"><i class="bi bi-book"></i> Data Mengajar Bulan Ini</h5>
                </div>
                <div class="card-body">
                    @if($data->guru && $data->guru->mengajar->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-light">
                                    <tr style="font-size: 0.875rem;">
                                        <th width="5%" class="text-center">No</th>
                                        <th>Mata Pelajaran</th>
                                        <th width="15%" class="text-center">Jumlah Jam</th>
                                        <th width="20%">Kelas</th>
                                    </tr>
                                </thead>
                                <tbody style="font-size: 0.875rem;">
                                    @php $totalJam = 0; @endphp
                                    @foreach($data->guru->mengajar as $index => $mengajar)
                                    @php $totalJam += $mengajar->mata_pelajaran->jumlah_jam ?? 0; @endphp
                                    <tr>
                                        <td class="text-center">
                                            <span class="badge bg-light text-dark">{{ $index + 1 }}</span>
                                        </td>
                                        <td class="fw-semibold">{{ $mengajar->mata_pelajaran->nama_mata_pelajaran ?? '-' }}</td>
                                        <td class="text-center">
                                            <span class="badge bg-primary">{{ $mengajar->mata_pelajaran->jumlah_jam ?? 0 }} jam</span>
                                        </td>
                                        <td>{{ $mengajar->kelas->nama_kelas ?? '-' }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot class="table-light">
                                    <tr class="fw-bold">
                                        <td colspan="2" class="text-end">Total Jam Mengajar:</td>
                                        <td class="text-center text-primary">{{ $totalJam }} jam</td>
                                        <td></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="bi bi-inbox text-muted" style="font-size: 2.5rem;"></i>
                            <p class="text-muted mt-2 mb-0">Belum ada data mengajar</p>
                        </div>
                    @endif
                </div>
            </div>

            {{-- RINCIAN HONOR --}}
            <div class="card shadow-sm border-0">
                <div class="card-header bg-warning text-dark">
                    <h5 class="mb-0"><i class="bi bi-cash-stack"></i> Rincian Honor & Gaji</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-borderless mb-0" style="font-size: 0.95rem;">
                            <tr class="border-bottom">
                                <td class="py-3" width="40%">
                                    <i class="bi bi-book-half me-2 text-primary"></i>
                                    <strong>Honor Mengajar</strong>
                                </td>
                                <td class="py-3 text-end fw-semibold">
                                    Rp {{ number_format($data->honor_mengajar ?? 0, 0, ',', '.') }}
                                </td>
                            </tr>
                            <tr class="border-bottom">
                                <td class="py-3">
                                    <i class="bi bi-trophy me-2 text-warning"></i>
                                    <strong>Honor Ekstrakurikuler</strong>
                                </td>
                                <td class="py-3 text-end fw-semibold">
                                    Rp {{ number_format($data->honor_ekstrakurikuler ?? 0, 0, ',', '.') }}
                                </td>
                            </tr>
                            <tr class="border-bottom">
                                <td class="py-3">
                                    <i class="bi bi-award me-2 text-danger"></i>
                                    <strong>Tunjangan Jabatan</strong>
                                </td>
                                <td class="py-3 text-end fw-semibold">
                                    Rp {{ number_format($data->honor_jabatan ?? 0, 0, ',', '.') }}
                                </td>
                            </tr>
                            <tr class="table-success">
                                <td class="py-4">
                                    <i class="bi bi-wallet2 me-2"></i>
                                    <strong class="fs-5">TOTAL GAJI</strong>
                                </td>
                                <td class="py-4 text-end">
                                    <strong class="fs-4 text-success">
                                        Rp {{ number_format($data->total_gaji ?? 0, 0, ',', '.') }}
                                    </strong>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- EKSTRAKURIKULER (OPTIONAL) --}}
    @if($data->guru && $data->guru->membina->count() > 0)
    <div class="row mt-4">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-info text-dark">
                    <h5 class="mb-0"><i class="bi bi-stars"></i> Ekstrakurikuler yang Dibina</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        @foreach($data->guru->membina as $membina)
                        <div class="col-md-4 mb-3">
                            <div class="d-flex align-items-center p-3 bg-light rounded">
                                <i class="bi bi-trophy-fill text-warning fs-3 me-3"></i>
                                <div>
                                    <strong>{{ $membina->ekstrakurikuler->nama_ekstrakurikuler ?? '-' }}</strong>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    {{-- ACTION BUTTONS --}}
    <div class="row mt-4">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <div class="d-flex gap-2 justify-content-between">
                        <a href="{{ route('perhitungan_gaji_guru.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i> Kembali ke Daftar
                        </a>
                        <button onclick="window.print()" class="btn btn-success">
                            <i class="bi bi-printer"></i> Cetak Slip Gaji
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- CUSTOM STYLES --}}
<style>
.card {
    transition: transform 0.2s;
}

.card:hover {
    transform: translateY(-2px);
}

.table-hover tbody tr:hover {
    background-color: rgba(0, 123, 255, 0.05);
}

.card-header {
    border-bottom: 3px solid rgba(0,0,0,0.1);
}

.badge {
    font-weight: 500;
    letter-spacing: 0.3px;
}

/* Print styles */
@media print {
    .btn, .card-body .d-flex {
        display: none !important;
    }
    
    .card {
        box-shadow: none !important;
        border: 1px solid #ddd !important;
    }
}
</style>

@endsection