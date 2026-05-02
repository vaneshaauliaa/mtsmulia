@extends('layouts.app')

@section('title', 'Perhitungan Gaji Guru')

@section('content')
<style>
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

    .alert-success { background: linear-gradient(135deg, #8B6914 0%, #CD853F 100%); color: white; }
    .alert-danger  { background: linear-gradient(135deg, #A0522D 0%, #D2691E 100%); color: white; }

    .filter-card {
        background: white;
        border-radius: 16px;
        padding: 1.5rem;
        box-shadow: 0 5px 25px rgba(0,0,0,0.08);
        margin-bottom: 2rem;
    }

    .filter-header {
        font-weight: 700;
        color: #8B4513;
        margin-bottom: 1rem;
        font-size: 1.05rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

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

    /* ── Searchable guru (filter) ── */
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
    .guru-option:hover, .guru-option.focused { background: #FFF8F0; }

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
    }

    .guru-option-empty {
        padding: 0.75rem 0.85rem;
        color: #9E9E9E;
        font-size: 13px;
        text-align: center;
    }

    .guru-dropdown::-webkit-scrollbar { width: 5px; }
    .guru-dropdown::-webkit-scrollbar-track { background: #f5ede4; border-radius: 10px; }
    .guru-dropdown::-webkit-scrollbar-thumb { background: #D2691E; border-radius: 10px; }

    .btn-filter {
        background: linear-gradient(135deg, #17a2b8 0%, #20c997 100%);
        border: none;
        padding: 0.55rem 1.4rem;
        border-radius: 8px;
        color: white;
        font-weight: 600;
        font-size: 14px;
        transition: box-shadow 0.2s, transform 0.2s;
        white-space: nowrap;
    }

    .btn-filter:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(23, 162, 184, 0.4);
        color: white;
    }

    .btn-reset {
        background: #F5F5F5;
        border: 2px solid #E0E0E0;
        padding: 0.55rem 1.4rem;
        border-radius: 8px;
        color: #5D4037;
        font-weight: 600;
        font-size: 14px;
        transition: background 0.2s;
        white-space: nowrap;
        text-decoration: none;
        display: inline-block;
    }

    .btn-reset:hover {
        background: #EEEEEE;
        color: #5D4037;
    }

    .btn-add {
        background: rgba(255,255,255,0.2);
        border: 1.5px solid rgba(255,255,255,0.6);
        padding: 0.55rem 1.4rem;
        border-radius: 8px;
        color: white;
        font-weight: 600;
        font-size: 14px;
        transition: background 0.2s;
        text-decoration: none;
        white-space: nowrap;
    }

    .btn-add:hover {
        background: rgba(255,255,255,0.35);
        color: white;
    }

    /* ── TABLE ── */
    .table-container {
        background: white;
        border-radius: 16px;
        box-shadow: 0 5px 25px rgba(0,0,0,0.08);
        overflow: hidden;
    }

    .table-wrap {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }

    .table-modern {
        width: 100%;
        min-width: 820px;
        table-layout: fixed;
        border-collapse: collapse;
        font-size: 13.5px;
        margin-bottom: 0;
    }

    .table-modern thead {
        background: linear-gradient(135deg, #8B4513 0%, #D2691E 100%);
    }

    .table-modern thead th {
        color: white;
        border: none;
        padding: 0.9rem 0.75rem;
        font-weight: 700;
        font-size: 11.5px;
        text-transform: uppercase;
        letter-spacing: 0.4px;
        vertical-align: middle;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .table-modern tbody tr {
        border-bottom: 1px solid #f5ede4;
        transition: background 0.15s;
    }

    .table-modern tbody tr:hover {
        background-color: #FFF8F0;
    }

    .table-modern tbody td {
        padding: 0.85rem 0.75rem;
        vertical-align: middle;
        border: none;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .table-modern tfoot td {
        padding: 1rem 0.75rem;
        background: linear-gradient(135deg, #FFF8F0 0%, #FFE4B5 100%);
        font-weight: 700;
        color: #8B4513;
        font-size: 14px;
        border-top: 3px solid #8B4513;
    }

    .col-no      { width: 48px; }
    .col-guru    { width: 18%; }
    .col-periode { width: 120px; }
    .col-money   { width: 14%; }
    .col-total   { width: 15%; }
    .col-aksi    { width: 88px; }

    .no-cell {
        background: linear-gradient(135deg, #8B4513 0%, #D2691E 100%);
        color: white;
        font-weight: 700;
        border-radius: 6px;
        width: 30px;
        height: 30px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
        flex-shrink: 0;
    }

    .badge-period {
        background: linear-gradient(135deg, #17a2b8 0%, #20c997 100%);
        color: white;
        padding: 0.35rem 0.7rem;
        border-radius: 8px;
        font-weight: 600;
        font-size: 11.5px;
        white-space: nowrap;
        display: inline-block;
    }

    .guru-name {
        font-weight: 600;
        color: #5D4037;
        font-size: 13.5px;
        margin-bottom: 2px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .guru-jabatan {
        color: #9E9E9E;
        font-size: 11.5px;
        font-weight: 500;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .amount-text {
        font-weight: 600;
        color: #5D4037;
        white-space: nowrap;
        font-size: 13px;
    }

    .total-amount {
        font-weight: 700;
        color: #8B6914;
        font-size: 14px;
        white-space: nowrap;
    }

    .btn-detail {
        background: linear-gradient(135deg, #17a2b8 0%, #20c997 100%);
        color: white;
        padding: 0.35rem 0.9rem;
        border-radius: 8px;
        border: none;
        font-size: 12.5px;
        font-weight: 600;
        transition: box-shadow 0.15s, transform 0.15s;
        white-space: nowrap;
        display: inline-block;
        text-decoration: none;
    }

    .btn-detail:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(23, 162, 184, 0.4);
        color: white;
    }

    .empty-state {
        padding: 4rem 2rem;
        text-align: center;
    }

    .empty-state i {
        font-size: 3.5rem;
        color: #8B4513;
        opacity: 0.45;
        display: block;
        margin-bottom: 0.75rem;
    }

    .empty-state p {
        color: #6D4C41;
        font-weight: 500;
        margin-bottom: 1.5rem;
    }

    .btn-add-plain {
        background: linear-gradient(135deg, #8B4513 0%, #D2691E 100%);
        border: none;
        padding: 0.55rem 1.4rem;
        border-radius: 8px;
        color: white;
        font-weight: 600;
        font-size: 14px;
        text-decoration: none;
        display: inline-block;
        box-shadow: 0 4px 15px rgba(139, 69, 19, 0.3);
    }
</style>

<div class="page-header">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
        <div>
            <h2 class="mb-1 fw-bold">&#128176; Perhitungan Gaji Guru</h2>
            <p class="mb-0 opacity-75">Kelola perhitungan gaji dan honor guru</p>
        </div>
        <a href="{{ route('perhitungan_gaji_guru.create') }}" class="btn-add">
            <i class="bi bi-plus-circle me-1"></i> Tambah Perhitungan
        </a>
    </div>
</div>

@if(session('success'))
<div class="alert alert-success alert-modern alert-dismissible fade show" role="alert">
    <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
</div>
@endif

@if(session('error'))
<div class="alert alert-danger alert-modern alert-dismissible fade show" role="alert">
    <i class="bi bi-exclamation-circle-fill me-2"></i>{{ session('error') }}
    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
</div>
@endif

{{-- FILTER --}}
<div class="filter-card">
    <div class="filter-header">
        <i class="bi bi-funnel-fill"></i> Filter Data
    </div>
    <form method="GET" action="{{ route('perhitungan_gaji_guru.index') }}" id="filterIndexForm">
        <div class="row g-3 align-items-end">

            {{-- Searchable Guru Filter --}}
            <div class="col-md-3 col-sm-6">
                <label class="form-label"><i class="bi bi-person me-1"></i>Guru</label>
                <div class="guru-search-wrapper">
                    <input
                        type="text"
                        class="guru-search-input"
                        id="guruFilterInput"
                        placeholder="Cari nama guru…"
                        autocomplete="off"
                        value="{{ request('guru_filter') ? (\App\Models\guru::find(request('guru_filter'))?->nama_guru ?? '') : '' }}"
                    >
                    <i class="bi bi-search guru-search-icon"></i>
                    <div class="guru-dropdown" id="guruFilterDropdown">
                        @foreach(\App\Models\guru::all() as $g)
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
                <input type="hidden" name="guru_filter" id="guruFilterId" value="{{ request('guru_filter') }}">
            </div>

            <div class="col-md-3 col-sm-6">
                <label class="form-label"><i class="bi bi-calendar-month me-1"></i>Bulan</label>
                <select name="bulan_filter" class="form-select">
                    <option value="">Semua Bulan</option>
                    @php
                    $bulanList = [1=>'Januari',2=>'Februari',3=>'Maret',4=>'April',
                                  5=>'Mei',6=>'Juni',7=>'Juli',8=>'Agustus',
                                  9=>'September',10=>'Oktober',11=>'November',12=>'Desember'];
                    @endphp
                    @foreach($bulanList as $key => $nama)
                        <option value="{{ $key }}" {{ request('bulan_filter') == $key ? 'selected' : '' }}>{{ $nama }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-2 col-sm-4">
                <label class="form-label"><i class="bi bi-calendar me-1"></i>Tahun</label>
                <input type="number" name="tahun_filter" class="form-control"
                       value="{{ request('tahun_filter') }}" placeholder="2024" min="2000" max="2099">
            </div>

            <div class="col-md-4 col-sm-8 d-flex gap-2">
                <button type="submit" class="btn btn-filter">
                    <i class="bi bi-search me-1"></i> Tampilkan
                </button>
                <a href="{{ route('perhitungan_gaji_guru.index') }}" class="btn-reset">
                    <i class="bi bi-arrow-clockwise me-1"></i> Reset
                </a>
            </div>

        </div>
    </form>
</div>

{{-- TABLE --}}
<div class="table-container">
    @if($data->count() > 0)
        <div class="table-wrap">
            <table class="table-modern">
                <colgroup>
                    <col class="col-no">
                    <col class="col-guru">
                    <col class="col-periode">
                    <col class="col-money">
                    <col class="col-money">
                    <col class="col-money">
                    <col class="col-total">
                    <col class="col-aksi">
                </colgroup>
                <thead>
                    <tr>
                        <th style="text-align:center;">No</th>
                        <th>Guru</th>
                        <th style="text-align:center;">Periode</th>
                        <th style="text-align:right;">Honor Mengajar</th>
                        <th style="text-align:right;">Honor Ekskul</th>
                        <th style="text-align:right;">Tunjangan Jabatan</th>
                        <th style="text-align:right;">Total Honor</th>
                        <th style="text-align:center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $bulanNama = [1=>'Jan',2=>'Feb',3=>'Mar',4=>'Apr',5=>'Mei',6=>'Jun',
                                  7=>'Jul',8=>'Agt',9=>'Sep',10=>'Okt',11=>'Nov',12=>'Des'];
                    @endphp
                    @foreach($data as $index => $item)
                    <tr>
                        <td style="text-align:center;">
                            <span class="no-cell">{{ $index + 1 }}</span>
                        </td>
                        <td>
                            <div class="guru-name">
                                <i class="bi bi-person-circle me-1" style="color:#8B4513;font-size:13px;"></i>
                                {{ $item->guru->nama_guru ?? '-' }}
                            </div>
                            @if($item->guru && $item->guru->jabatan)
                                <div class="guru-jabatan">{{ $item->guru->jabatan->nama_jabatan }}</div>
                            @endif
                        </td>
                        <td style="text-align:center;">
                            <span class="badge-period">
                                <i class="bi bi-calendar3 me-1" style="font-size:11px;"></i>
                                {{ $bulanNama[$item->bulan] ?? '-' }} {{ $item->tahun }}
                            </span>
                        </td>
                        <td style="text-align:right;" class="amount-text">
                            Rp&nbsp;{{ number_format($item->honor_mengajar ?? 0, 0, ',', '.') }}
                        </td>
                        <td style="text-align:right;" class="amount-text">
                            Rp&nbsp;{{ number_format($item->honor_ekstrakurikuler ?? 0, 0, ',', '.') }}
                        </td>
                        <td style="text-align:right;" class="amount-text">
                            Rp&nbsp;{{ number_format($item->honor_jabatan ?? 0, 0, ',', '.') }}
                        </td>
                        <td style="text-align:right;" class="total-amount">
                            Rp&nbsp;{{ number_format($item->total_gaji ?? 0, 0, ',', '.') }}
                        </td>
                        <td style="text-align:center;">
                            <a href="{{ route('perhitungan_gaji_guru.show', $item->id) }}" class="btn-detail">
                                <i class="bi bi-eye me-1" style="font-size:12px;"></i>Detail
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="6" style="text-align:right;">
                            <i class="bi bi-calculator me-2"></i>Total Keseluruhan
                        </td>
                        <td style="text-align:right;font-size:15px;color:#8B4513;white-space:nowrap;">
                            Rp&nbsp;{{ number_format($data->sum('total_gaji'), 0, ',', '.') }}
                        </td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    @else
        <div class="empty-state">
            <i class="bi bi-inbox"></i>
            <p>Belum ada data perhitungan gaji guru</p>
            <a href="{{ route('perhitungan_gaji_guru.create') }}" class="btn-add-plain">
                <i class="bi bi-plus-circle me-2"></i>Tambah Data Pertama
            </a>
        </div>
    @endif
</div>

<script>
// ── Reusable searchable dropdown factory ──
function makeSearchableGuru(inputEl, dropdownEl, hiddenEl, guruList) {
    let focusedIndex = -1;

    function render(query) {
        const q = query.toLowerCase();
        const filtered = guruList.filter(g =>
            g.nama.toLowerCase().includes(q) || g.nip.toLowerCase().includes(q)
        );

        dropdownEl.innerHTML = '';

        if (filtered.length === 0) {
            dropdownEl.innerHTML = '<div class="guru-option-empty">Guru tidak ditemukan</div>';
        } else {
            filtered.forEach(g => {
                const div = document.createElement('div');
                div.className = 'guru-option';
                div.innerHTML = `
                    <div class="guru-option-name">${g.nama}</div>
                    <div class="guru-option-nip">NIP: ${g.nip || '-'}</div>
                `;
                div.addEventListener('mousedown', e => {
                    e.preventDefault();
                    select(g);
                });
                dropdownEl.appendChild(div);
            });
        }

        focusedIndex = -1;
    }

    function select(g) {
        hiddenEl.value  = g.id;
        inputEl.value   = g.nama + (g.nip ? ' — ' + g.nip : '');
        dropdownEl.classList.remove('show');
    }

    inputEl.addEventListener('focus', () => { render(inputEl.value); dropdownEl.classList.add('show'); });
    inputEl.addEventListener('input', () => { hiddenEl.value = ''; render(inputEl.value); dropdownEl.classList.add('show'); });
    inputEl.addEventListener('blur',  () => { setTimeout(() => dropdownEl.classList.remove('show'), 150); });
    inputEl.addEventListener('keydown', e => {
        const opts = dropdownEl.querySelectorAll('.guru-option');
        if (e.key === 'ArrowDown') { e.preventDefault(); focusedIndex = Math.min(focusedIndex + 1, opts.length - 1); }
        else if (e.key === 'ArrowUp') { e.preventDefault(); focusedIndex = Math.max(focusedIndex - 1, 0); }
        else if (e.key === 'Enter' && focusedIndex >= 0) {
            e.preventDefault();
            const opt = opts[focusedIndex];
            select({ id: opt.dataset.id, nama: opt.dataset.name, nip: opt.dataset.nip });
            return;
        } else if (e.key === 'Escape') { dropdownEl.classList.remove('show'); return; }
        opts.forEach((o, i) => o.classList.toggle('focused', i === focusedIndex));
        if (opts[focusedIndex]) opts[focusedIndex].scrollIntoView({ block: 'nearest' });
    });
}

const guruList = @json(\App\Models\guru::all()->map(fn($g) => ['id' => $g->id_guru, 'nama' => $g->nama_guru, 'code' => $g->id_guru]));

function makeSearchableGuru(inputEl, dropdownEl, hiddenEl, guruList) {
    let focusedIndex = -1;

    function render(query) {
        const q = query.toLowerCase();
        const filtered = guruList.filter(g =>
            g.nama.toLowerCase().includes(q) || g.code.toLowerCase().includes(q)
        );

        dropdownEl.innerHTML = '';

        if (filtered.length === 0) {
            dropdownEl.innerHTML = '<div class="guru-option-empty">Guru tidak ditemukan</div>';
        } else {
            filtered.forEach(g => {
                const div = document.createElement('div');
                div.className = 'guru-option';
                div.dataset.id   = g.id;
                div.dataset.name = g.nama;
                div.dataset.code = g.code;
                div.innerHTML = `
                    <div class="guru-option-name">${g.nama}</div>
                    <div class="guru-option-nip">ID: ${g.code}</div>
                `;
                div.addEventListener('mousedown', e => {
                    e.preventDefault();
                    select(g);
                });
                dropdownEl.appendChild(div);
            });
        }

        focusedIndex = -1;
    }

    function select(g) {
        hiddenEl.value = g.id;
        inputEl.value  = g.nama;
        dropdownEl.classList.remove('show');
    }

    inputEl.addEventListener('focus', () => { render(inputEl.value); dropdownEl.classList.add('show'); });
    inputEl.addEventListener('input', () => { hiddenEl.value = ''; render(inputEl.value); dropdownEl.classList.add('show'); });
    inputEl.addEventListener('blur',  () => { setTimeout(() => dropdownEl.classList.remove('show'), 150); });
    inputEl.addEventListener('keydown', e => {
        const opts = dropdownEl.querySelectorAll('.guru-option');
        if (e.key === 'ArrowDown') { e.preventDefault(); focusedIndex = Math.min(focusedIndex + 1, opts.length - 1); }
        else if (e.key === 'ArrowUp') { e.preventDefault(); focusedIndex = Math.max(focusedIndex - 1, 0); }
        else if (e.key === 'Enter' && focusedIndex >= 0) {
            e.preventDefault();
            const opt = opts[focusedIndex];
            select({ id: opt.dataset.id, nama: opt.dataset.name, code: opt.dataset.code });
            return;
        } else if (e.key === 'Escape') { dropdownEl.classList.remove('show'); return; }
        opts.forEach((o, i) => o.classList.toggle('focused', i === focusedIndex));
        if (opts[focusedIndex]) opts[focusedIndex].scrollIntoView({ block: 'nearest' });
    });
}

makeSearchableGuru(
    document.getElementById('guruFilterInput'),
    document.getElementById('guruFilterDropdown'),
    document.getElementById('guruFilterId'),
    guruList
);

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