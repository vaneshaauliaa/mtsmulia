@extends('layouts.app')

@section('title', 'Tambah Perhitungan Gaji Guru')

@section('content')
<div class="container-fluid">
    <h4 class="mb-3 fw-semibold">Tambah Perhitungan Gaji Guru</h4>

    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow-sm border-0">
                <div class="card-body">

                    {{-- Progress Steps --}}
                    <div class="d-flex justify-content-center mb-4">
                        <div class="step-item active" id="step-indicator-1" style="max-width: 250px;">
                            <div class="step-number">1</div>
                            <div class="step-title">Pilih Guru & Periode</div>
                        </div>
                        <div class="step-item" id="step-indicator-2" style="max-width: 250px;">
                            <div class="step-number">2</div>
                            <div class="step-title">Verifikasi Data & Simpan</div>
                        </div>
                    </div>

                    {{-- SECTION 1: PILIH GURU & PERIODE --}}
                    <div class="form-section active" id="section-1">
                        <h5 class="mb-4 fw-semibold text-primary">Pilih Guru & Periode</h5>

                        <form method="GET" action="{{ route('perhitungan_gaji_guru.create') }}" id="filterForm">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Guru <span class="text-danger">*</span></label>
                                    <select name="id_guru" class="form-select" id="selectGuru">
                                        <option value="">-- Pilih Guru --</option>
                                        @foreach($guruList as $g)
                                            <option value="{{ $g->id_guru }}"
                                                {{ request('id_guru') == $g->id_guru ? 'selected' : '' }}>
                                                {{ $g->nama_guru }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                @php
                                $bulanList = [
                                    1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
                                    5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
                                    9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember',
                                ];
                                @endphp

                                <div class="col-md-3 mb-3">
                                    <label class="form-label">Bulan <span class="text-danger">*</span></label>
                                    <select name="bulan" class="form-select" id="selectBulan">
                                        <option value="">-- Pilih Bulan --</option>
                                        @foreach($bulanList as $key => $nama)
                                            <option value="{{ $key }}"
                                                {{ request('bulan') == $key ? 'selected' : '' }}>
                                                {{ $nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label class="form-label">Tahun <span class="text-danger">*</span></label>
                                    <input type="number" name="tahun" class="form-control" id="inputTahun"
                                           value="{{ request('tahun') ?? date('Y') }}">
                                </div>
                            </div>

                            <div class="d-flex justify-content-between mt-4">
                                <a href="{{ route('perhitungan_gaji_guru.index') }}" class="btn btn-secondary">Batal</a>
                                <button type="button" class="btn btn-primary" onclick="loadData()">
                                    Muat Data & Lanjut →
                                </button>
                            </div>
                        </form>
                    </div>

                    @if($guru)
                    {{-- SECTION 2: DATA MENGAJAR & RINCIAN HONOR --}}
                    <div class="form-section" id="section-2">
                        <div class="row">
                            {{-- Tabel Data Mengajar --}}
                            <div class="col-lg-7">
                                <h5 class="mb-4 fw-semibold text-primary">Data Mengajar</h5>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-sm align-middle">
                                        <thead class="table-light">
                                            <tr class="text-center">
                                                <th>Mata Pelajaran</th>
                                                <th width="20%">Jam</th>
                                                <th width="20%">Kelas</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($guru->mengajar as $m)
                                            <tr>
                                                <td class="ps-3">{{ $m->mata_pelajaran->nama_mata_pelajaran }}</td>
                                                <td class="text-center">{{ $m->mata_pelajaran->jumlah_jam }} jam</td>
                                                <td class="text-center"><span class="badge bg-primary">{{ $m->kelas->nama_kelas }}</span></td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot class="table-light fw-bold">
                                            <tr>
                                                <td class="text-end">Total Jam:</td>
                                                <td class="text-center text-primary">{{ $totalJam }} jam</td>
                                                <td></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>

                            {{-- Card Rincian Honor --}}
                            <div class="col-lg-5">
                                <h5 class="mb-4 fw-semibold text-primary">Rincian Honor</h5>
                                <div class="card border-0 bg-light">
                                    <div class="card-body">
                                        <table class="table table-borderless table-sm mb-0">
                                            <tr>
                                                <td>Honor Mengajar</td>
                                                <td class="text-end fw-semibold">Rp {{ number_format($totalHonorMengajar, 0, ',', '.') }}</td>
                                            </tr>
                                            <tr>
                                                <td>Honor Eskul</td>
                                                <td class="text-end fw-semibold">Rp {{ number_format($honorEskul, 0, ',', '.') }}</td>
                                            </tr>
                                            <tr class="border-bottom">
                                                <td>Honor Jabatan</td>
                                                <td class="text-end fw-semibold">Rp {{ number_format($honorJabatan, 0, ',', '.') }}</td>
                                            </tr>
                                            <tr class="table-success">
                                                <td class="py-3 fw-bold">TOTAL TERIMA</td>
                                                <td class="py-3 text-end fw-bold text-success fs-5">Rp {{ number_format($totalHonor, 0, ',', '.') }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>

                                <form method="POST" action="{{ route('perhitungan_gaji_guru.store') }}" class="mt-4">
                                    @csrf
                                    <input type="hidden" name="id_guru" value="{{ $guru->id_guru }}">
                                    <input type="hidden" name="bulan" value="{{ request('bulan') }}">
                                    <input type="hidden" name="tahun" value="{{ request('tahun') }}">
                                    <input type="hidden" name="honor_mengajar" value="{{ $totalHonorMengajar }}">
                                    <input type="hidden" name="honor_ekstrakurikuler" value="{{ $honorEskul }}">
                                    <input type="hidden" name="honor_jabatan" value="{{ $honorJabatan }}">
                                    <input type="hidden" name="total_honor" value="{{ $totalHonor }}">

                                    <div class="d-flex justify-content-between">
                                        <button type="button" class="btn btn-outline-secondary" onclick="prevSection(1)">← Kembali</button>
                                        <button type="submit" class="btn btn-success px-4">
                                            <i class="bi bi-check-circle"></i> Simpan & Selesai
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>

<style>
.step-item {
    flex: 1;
    text-align: center;
    position: relative;
    padding: 10px;
}
.step-item:not(:last-child)::after {
    content: '';
    position: absolute;
    top: 25px;
    right: -50%;
    width: 100%;
    height: 2px;
    background: #dee2e6;
    z-index: -1;
}
.step-item.active:not(:last-child)::after { background: #0d6efd; }
.step-item.completed:not(:last-child)::after { background: #198754; }

.step-number {
    width: 40px; height: 40px;
    border-radius: 50%;
    background: #dee2e6;
    color: #6c757d;
    display: inline-flex;
    align-items: center; justify-content: center;
    font-weight: bold; margin-bottom: 8px;
}
.step-item.active .step-number { background: #0d6efd; color: white; }
.step-item.completed .step-number { background: #198754; color: white; }
.step-title { font-size: 13px; font-weight: 500; color: #6c757d; }
.step-item.active .step-title { color: #0d6efd; font-weight: 600; }

.form-section { display: none; }
.form-section.active { display: block; animation: fadeIn 0.3s; }
@keyframes fadeIn { from { opacity: 0; transform: translateY(5px); } to { opacity: 1; transform: translateY(0); } }
</style>

<script>
function loadData() {
    const guru = document.getElementById('selectGuru').value;
    const bulan = document.getElementById('selectBulan').value;
    const tahun = document.getElementById('inputTahun').value;

    if (!guru || !bulan || !tahun) {
        alert('Mohon lengkapi semua field!');
        return;
    }
    document.getElementById('filterForm').submit();
}

function nextSection(sectionNumber) {
    document.querySelectorAll('.form-section').forEach(s => s.classList.remove('active'));
    document.getElementById('section-' + sectionNumber).classList.add('active');
    updateStepIndicators(sectionNumber);
}

function prevSection(sectionNumber) {
    document.querySelectorAll('.form-section').forEach(s => s.classList.remove('active'));
    document.getElementById('section-' + sectionNumber).classList.add('active');
    updateStepIndicators(sectionNumber);
}

function updateStepIndicators(currentSection) {
    document.querySelectorAll('.step-item').forEach((step, index) => {
        step.classList.remove('active', 'completed');
        if (index + 1 < currentSection) step.classList.add('completed');
        else if (index + 1 === currentSection) step.classList.add('active');
    });
}

@if($guru)
document.addEventListener('DOMContentLoaded', function() {
    nextSection(2);
});
@endif
</script>
@endsection