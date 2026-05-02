@extends('layouts.app')

@section('title', 'Tambah Perhitungan Gaji Guru')

@section('content')

<style>
    /* ── Shared base (matches index) ── */
    .page-header {
        background: linear-gradient(135deg, #8B4513 0%, #D2691E 100%);
        border-radius: 16px;
        padding: 2rem;
        margin-bottom: 2rem;
        color: white;
        box-shadow: 0 10px 30px rgba(139, 69, 19, 0.3);
    }

    .alert-modern {
        border: none;
        border-radius: 12px;
        padding: 1rem 1.5rem;
        margin-bottom: 1.5rem;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }
    .alert-danger { background: linear-gradient(135deg, #A0522D 0%, #D2691E 100%); color: white; }

    /* ── Card ── */
    .main-card {
        background: white;
        border-radius: 16px;
        box-shadow: 0 5px 25px rgba(0,0,0,0.08);
        overflow: hidden;
    }

    .main-card .card-body {
        padding: 2rem;
    }

    /* ── Section title ── */
    .section-title {
        font-weight: 700;
        color: #8B4513;
        font-size: 1rem;
        margin-bottom: 1.25rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    /* ── Form controls (matches index filter style) ── */
    .form-label {
        font-weight: 600;
        color: #5D4037;
        margin-bottom: 0.4rem;
        font-size: 13px;
        display: block;
    }

    .form-control, .form-select {
        border: 2px solid #E0D5C7;
        border-radius: 8px;
        padding: 0.55rem 0.85rem;
        font-size: 14px;
        transition: border-color 0.2s, box-shadow 0.2s;
        width: 100%;
    }

    .form-control:focus, .form-select:focus {
        border-color: #8B4513;
        box-shadow: 0 0 0 0.2rem rgba(139, 69, 19, 0.15);
        outline: none;
    }

    /* ── Searchable guru dropdown ── */
    .guru-search-wrapper {
        position: relative;
    }

    .guru-search-input {
        border: 2px solid #E0D5C7;
        border-radius: 8px;
        padding: 0.55rem 2.2rem 0.55rem 0.85rem;
        font-size: 14px;
        width: 100%;
        transition: border-color 0.2s, box-shadow 0.2s;
        background: white;
        cursor: text;
    }

    .guru-search-input:focus {
        border-color: #8B4513;
        box-shadow: 0 0 0 0.2rem rgba(139, 69, 19, 0.15);
        outline: none;
    }

    .guru-search-icon {
        position: absolute;
        right: 0.75rem;
        top: 50%;
        transform: translateY(-50%);
        color: #8B4513;
        font-size: 14px;
        pointer-events: none;
    }

    .guru-dropdown {
        position: absolute;
        top: calc(100% + 4px);
        left: 0;
        right: 0;
        background: white;
        border: 2px solid #E0D5C7;
        border-radius: 10px;
        box-shadow: 0 8px 24px rgba(0,0,0,0.14);
        z-index: 1050;
        max-height: 220px;
        overflow-y: auto;
        display: none;
    }

    .guru-dropdown.show { display: block; }

    .guru-option {
        padding: 0.5rem 0.85rem;
        cursor: pointer;
        border-bottom: 1px solid #F5EDE4;
        transition: background 0.15s;
    }

    .guru-option:last-child { border-bottom: none; }

    .guru-option:hover, .guru-option.focused {
        background: #FFF8F0;
    }

    .guru-option-name {
        font-weight: 600;
        color: #5D4037;
        font-size: 13px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .guru-option-nip {
        color: #9E9E9E;
        font-size: 11.5px;
        white-space: nowrap;
    }

    .guru-option-empty {
        padding: 0.75rem 0.85rem;
        color: #9E9E9E;
        font-size: 13px;
        text-align: center;
    }

    /* ── Divider ── */
    .section-divider {
        border: none;
        border-top: 2px dashed #E0D5C7;
        margin: 1.75rem 0;
    }

    /* ── Result panel ── */
    .result-panel {
        background: #FFF8F0;
        border-radius: 12px;
        border: 1.5px solid #E0D5C7;
        padding: 1.25rem 1.5rem;
        display: none;
    }

    .result-panel.show { display: block; }

    /* ── Teaching table ── */
    .teach-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 13px;
    }

    .teach-table thead th {
        background: linear-gradient(135deg, #8B4513 0%, #D2691E 100%);
        color: white;
        padding: 0.6rem 0.75rem;
        font-size: 11.5px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.3px;
        border: none;
    }

    .teach-table tbody td {
        padding: 0.6rem 0.75rem;
        border-bottom: 1px solid #F5EDE4;
        color: #5D4037;
        vertical-align: middle;
    }

    .teach-table tfoot td {
        padding: 0.7rem 0.75rem;
        background: #F5EDE4;
        font-weight: 700;
        color: #8B4513;
        font-size: 13px;
        border-top: 2px solid #D2691E;
    }

    /* ── Honor breakdown ── */
    .honor-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 13.5px;
    }

    .honor-table tr { border-bottom: 1px solid #E0D5C7; }
    .honor-table tr:last-child { border-bottom: none; }

    .honor-table td {
        padding: 0.6rem 0;
        color: #5D4037;
        vertical-align: middle;
    }

    .honor-table .total-row td {
        padding-top: 0.85rem;
        font-weight: 700;
        font-size: 15px;
        color: #8B4513;
        border-top: 2px solid #D2691E;
        border-bottom: none;
    }

    .amount-col { text-align: right; font-weight: 600; }

    /* ── Buttons ── */
    .btn-load {
        background: linear-gradient(135deg, #17a2b8 0%, #20c997 100%);
        border: none;
        padding: 0.55rem 1.4rem;
        border-radius: 8px;
        color: white;
        font-weight: 600;
        font-size: 14px;
        transition: box-shadow 0.2s, transform 0.2s;
        white-space: nowrap;
        cursor: pointer;
    }

    .btn-load:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(23, 162, 184, 0.4);
        color: white;
    }

    .btn-save {
        background: linear-gradient(135deg, #198754 0%, #20c997 100%);
        border: none;
        padding: 0.55rem 1.6rem;
        border-radius: 8px;
        color: white;
        font-weight: 700;
        font-size: 14px;
        transition: box-shadow 0.2s, transform 0.2s;
        cursor: pointer;
    }

    .btn-save:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(25, 135, 84, 0.4);
        color: white;
    }

    .btn-back {
        background: #F5F5F5;
        border: 2px solid #E0E0E0;
        padding: 0.55rem 1.4rem;
        border-radius: 8px;
        color: #5D4037;
        font-weight: 600;
        font-size: 14px;
        text-decoration: none;
        display: inline-block;
    }

    .btn-back:hover {
        background: #EEEEEE;
        color: #5D4037;
    }

    .badge-kelas {
        background: linear-gradient(135deg, #17a2b8 0%, #20c997 100%);
        color: white;
        padding: 0.25rem 0.6rem;
        border-radius: 6px;
        font-size: 11px;
        font-weight: 600;
    }

    /* scrollbar for dropdown */
    .guru-dropdown::-webkit-scrollbar { width: 5px; }
    .guru-dropdown::-webkit-scrollbar-track { background: #f5ede4; border-radius: 10px; }
    .guru-dropdown::-webkit-scrollbar-thumb { background: #D2691E; border-radius: 10px; }
</style>

<div class="page-header">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
        <div>
            <h2 class="mb-1 fw-bold">&#128176; Tambah Perhitungan Gaji Guru</h2>
            <p class="mb-0 opacity-75">Pilih guru dan periode untuk menghitung honor</p>
        </div>
        <a href="{{ route('perhitungan_gaji_guru.index') }}" class="btn-back">
            <i class="bi bi-arrow-left me-1"></i> Kembali
        </a>
    </div>
</div>

@if(session('error'))
<div class="alert alert-danger alert-modern alert-dismissible fade show" role="alert">
    <i class="bi bi-exclamation-circle-fill me-2"></i>{{ session('error') }}
    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
</div>
@endif

<div class="main-card">
    <div class="card-body">

        {{-- ── FILTER FORM ── --}}
        <div class="section-title">
            <i class="bi bi-funnel-fill"></i> Pilih Guru & Periode
        </div>

        <form method="GET" action="{{ route('perhitungan_gaji_guru.create') }}" id="filterForm">

            <div class="row g-3 align-items-end">

                {{-- Searchable Guru --}}
                <div class="col-md-5">
                    <label class="form-label">Guru <span class="text-danger">*</span></label>
                    <div class="guru-search-wrapper" id="guruWrapper">
                        <input
                            type="text"
                            class="guru-search-input"
                            id="guruSearchInput"
                            placeholder="Cari nama guru…"
                            autocomplete="off"
                            value="{{ $guru ? $guru->nama_guru : '' }}"
                        >
                        <i class="bi bi-search guru-search-icon"></i>

                        <div class="guru-dropdown" id="guruDropdown">
                            @foreach($guruList as $g)
                            <div class="guru-option"
                                 data-id="{{ $g->id_guru }}"
                                 data-name="{{ $g->nama_guru }}"
                                 data-code="{{ $g->id_guru }}">
                                <div class="guru-option-name">{{ $g->nama_guru }}</div>
                                <div class="guru-option-nip">ID: {{ $g->id_guru }}</div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <input type="hidden" name="id_guru" id="selectedGuruId" value="{{ request('id_guru') }}">
                </div>

                {{-- Bulan --}}
                @php
                $bulanList = [
                    1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
                    5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
                    9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember',
                ];
                @endphp

                <div class="col-md-3">
                    <label class="form-label">Bulan <span class="text-danger">*</span></label>
                    <select name="bulan" class="form-select" id="selectBulan">
                        <option value="">-- Pilih Bulan --</option>
                        @foreach($bulanList as $key => $nama)
                            <option value="{{ $key }}" {{ request('bulan') == $key ? 'selected' : '' }}>{{ $nama }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Tahun --}}
                <div class="col-md-2">
                    <label class="form-label">Tahun <span class="text-danger">*</span></label>
                    <input type="number" name="tahun" class="form-control" id="inputTahun"
                           value="{{ request('tahun') ?? date('Y') }}" min="2000" max="2099">
                </div>

                {{-- Tombol --}}
                <div class="col-md-2 d-flex">
                    <button type="button" class="btn-load w-100" onclick="loadData()">
                        <i class="bi bi-search me-1"></i> Muat Data
                    </button>
                </div>
            </div>

        </form>

        {{-- ── RESULT SECTION (shown after data loaded) ── --}}
        @if($guru)
        <hr class="section-divider">

        <div class="section-title">
            <i class="bi bi-table"></i> Rincian Data &amp; Honor
        </div>

        <div class="row g-4">

            {{-- Tabel Mengajar --}}
            <div class="col-lg-7">
                <div class="mb-2" style="font-size:13px;font-weight:600;color:#8B4513;">
                    <i class="bi bi-person-circle me-1"></i>
                    {{ $guru->nama_guru }}
                    @if($guru->jabatan)
                        <span style="color:#9E9E9E;font-weight:500;">— {{ $guru->jabatan->nama_jabatan }}</span>
                    @endif
                </div>
                <div style="overflow-x:auto;">
                    <table class="teach-table">
                        <thead>
                            <tr>
                                <th>Mata Pelajaran</th>
                                <th style="text-align:center;width:90px;">Jam</th>
                                <th style="text-align:center;width:100px;">Kelas</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($guru->mengajar as $m)
                            <tr>
                                <td>{{ $m->mata_pelajaran->nama_mata_pelajaran }}</td>
                                <td style="text-align:center;">{{ $m->mata_pelajaran->jumlah_jam }} jam</td>
                                <td style="text-align:center;"><span class="badge-kelas">{{ $m->kelas->nama_kelas }}</span></td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td style="text-align:right;">Total Jam:</td>
                                <td style="text-align:center;">{{ $totalJam }} jam</td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

            {{-- Honor Breakdown --}}
            <div class="col-lg-5">
                <div class="result-panel show">
                    <div class="mb-3" style="font-weight:700;color:#8B4513;font-size:13.5px;">
                        <i class="bi bi-cash-stack me-1"></i> Rincian Honor
                    </div>
                    <table class="honor-table">
                        <tr>
                            <td>Honor Mengajar</td>
                            <td class="amount-col">Rp {{ number_format($totalHonorMengajar, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <td>Honor Eskul</td>
                            <td class="amount-col">Rp {{ number_format($honorEskul, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <td>Honor Jabatan</td>
                            <td class="amount-col">Rp {{ number_format($honorJabatan, 0, ',', '.') }}</td>
                        </tr>
                        <tr class="total-row">
                            <td><i class="bi bi-check-circle me-1"></i>Total Terima</td>
                            <td class="amount-col" style="color:#198754;">Rp {{ number_format($totalHonor, 0, ',', '.') }}</td>
                        </tr>
                    </table>

                    <form method="POST" action="{{ route('perhitungan_gaji_guru.store') }}" class="mt-4">
                        @csrf
                        <input type="hidden" name="id_guru" value="{{ $guru->id_guru }}">
                        <input type="hidden" name="bulan" value="{{ request('bulan') }}">
                        <input type="hidden" name="tahun" value="{{ request('tahun') }}">
                        <input type="hidden" name="honor_mengajar" value="{{ $totalHonorMengajar }}">
                        <input type="hidden" name="honor_ekstrakurikuler" value="{{ $honorEskul }}">
                        <input type="hidden" name="honor_jabatan" value="{{ $honorJabatan }}">
                        <input type="hidden" name="total_honor" value="{{ $totalHonor }}">

                        <button type="submit" class="btn-save w-100">
                            <i class="bi bi-check-circle me-1"></i> Simpan Perhitungan
                        </button>
                    </form>
                </div>
            </div>

        </div>
        @endif

    </div>
</div>

<script>
// ── Searchable Guru Dropdown ──
const guruData = @json($guruList->map(fn($g) => ['id' => $g->id_guru, 'nama' => $g->nama_guru, 'code' => $g->id_guru]));

const searchInput  = document.getElementById('guruSearchInput');
const dropdown     = document.getElementById('guruDropdown');
const hiddenInput  = document.getElementById('selectedGuruId');

let focusedIndex = -1;

function renderOptions(query) {
    const q = query.toLowerCase();
    const filtered = guruData.filter(g =>
        g.nama.toLowerCase().includes(q) || g.code.toLowerCase().includes(q)
    );

    dropdown.innerHTML = '';

    if (filtered.length === 0) {
        dropdown.innerHTML = '<div class="guru-option-empty">Guru tidak ditemukan</div>';
    } else {
        filtered.forEach((g, i) => {
            const div = document.createElement('div');
            div.className = 'guru-option';
            div.dataset.id   = g.id;
            div.dataset.name = g.nama;
            div.dataset.code = g.code;
            div.innerHTML = `
                <div class="guru-option-name">${g.nama}</div>
                <div class="guru-option-nip">ID: ${g.code}</div>
            `;
            div.addEventListener('mousedown', function(e) {
                e.preventDefault();
                selectGuru(g.id, g.nama);
            });
            dropdown.appendChild(div);
        });
    }

    focusedIndex = -1;
}

function selectGuru(id, nama) {
    hiddenInput.value = id;
    searchInput.value = nama;
    dropdown.classList.remove('show');
}

searchInput.addEventListener('focus', function() {
    renderOptions(this.value);
    dropdown.classList.add('show');
});

searchInput.addEventListener('input', function() {
    hiddenInput.value = '';
    renderOptions(this.value);
    dropdown.classList.add('show');
});

searchInput.addEventListener('blur', function() {
    setTimeout(() => dropdown.classList.remove('show'), 150);
});

searchInput.addEventListener('keydown', function(e) {
    const options = dropdown.querySelectorAll('.guru-option');
    if (e.key === 'ArrowDown') {
        e.preventDefault();
        focusedIndex = Math.min(focusedIndex + 1, options.length - 1);
    } else if (e.key === 'ArrowUp') {
        e.preventDefault();
        focusedIndex = Math.max(focusedIndex - 1, 0);
    } else if (e.key === 'Enter' && focusedIndex >= 0) {
        e.preventDefault();
        const opt = options[focusedIndex];
        selectGuru(opt.dataset.id, opt.dataset.name);
        return;
    } else if (e.key === 'Escape') {
        dropdown.classList.remove('show');
        return;
    }
    options.forEach((o, i) => o.classList.toggle('focused', i === focusedIndex));
    if (options[focusedIndex]) options[focusedIndex].scrollIntoView({ block: 'nearest' });
});

// ── Load Data ──
function loadData() {
    const guru  = document.getElementById('selectedGuruId').value;
    const bulan = document.getElementById('selectBulan').value;
    const tahun = document.getElementById('inputTahun').value;

    if (!guru || !bulan || !tahun) {
        alert('Mohon lengkapi semua field!');
        return;
    }

    document.getElementById('filterForm').submit();
}

// Auto-dismiss alerts
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.alert').forEach(function (el) {
        setTimeout(function () {
            if (window.bootstrap) bootstrap.Alert.getOrCreateInstance(el).close();
        }, 5000);
    });
});
</script>

@endsection