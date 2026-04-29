@extends('layouts.app')

@section('title', 'Laporan Dana Keluar')

@section('content')
<style>
    .report-container {
        background: white;
        border-radius: 16px;
        box-shadow: 0 5px 25px rgba(0,0,0,0.08);
        padding: 2.5rem;
        max-width: 1200px;
        margin: 0 auto;
    }

    .report-header {
        text-align: center;
        margin-bottom: 2rem;
        padding-bottom: 1.5rem;
        border-bottom: 3px solid #A0522D;
    }

    .school-logo {
        width: 80px;
        height: 80px;
        margin: 0 auto 1rem;
    }

    .school-name {
        font-size: 1.8rem;
        font-weight: 700;
        color: #5D4037;
        margin-bottom: 0.5rem;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .report-title {
        font-size: 1.3rem;
        font-weight: 600;
        color: #A0522D;
        margin-bottom: 0.5rem;
    }

    .report-period {
        font-size: 1rem;
        color: #6D4C41;
        font-weight: 500;
    }

    .filter-section {
        background: linear-gradient(135deg, #FFF0F0 0%, #FFE4E4 100%);
        padding: 1.5rem;
        border-radius: 12px;
        margin-bottom: 2rem;
        border-left: 4px solid #A0522D;
    }

    .filter-title {
        font-weight: 700;
        color: #A0522D;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .form-control, .form-select {
        border: 2px solid #FFDDDD;
        border-radius: 8px;
        padding: 0.6rem 1rem;
        font-size: 14px;
    }

    .form-control:focus, .form-select:focus {
        border-color: #A0522D;
        box-shadow: 0 0 0 0.2rem rgba(160, 82, 45, 0.15);
        outline: none;
    }

    .btn-filter {
        background: linear-gradient(135deg, #A0522D 0%, #D2691E 100%);
        border: none;
        padding: 0.6rem 1.5rem;
        border-radius: 8px;
        color: white;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-filter:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(160, 82, 45, 0.4);
        color: white;
    }

    .btn-print {
        background: white;
        border: 2px solid #A0522D;
        padding: 0.6rem 1.5rem;
        border-radius: 8px;
        color: #A0522D;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-print:hover {
        background: #A0522D;
        color: white;
    }

    .table-report {
        font-size: 14px;
        margin-bottom: 0;
    }

    .table-report thead {
        background: linear-gradient(135deg, #A0522D 0%, #D2691E 100%);
        color: white;
    }

    .table-report thead th {
        padding: 1rem 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 12px;
        letter-spacing: 0.5px;
        border: none;
        vertical-align: middle;
    }

    .table-report tbody td {
        padding: 0.9rem 0.75rem;
        vertical-align: middle;
        border-color: #F5F5F5;
    }

    .table-report tbody tr {
        transition: all 0.3s ease;
    }

    .table-report tbody tr:hover {
        background-color: #FFF8F0;
    }

    .table-report tfoot {
        background: linear-gradient(135deg, #FFF0F0 0%, #FFE4E4 100%);
        font-weight: 700;
    }

    .table-report tfoot td {
        padding: 1rem 0.75rem;
        color: #A0522D;
        font-size: 15px;
        border-top: 3px solid #A0522D;
    }

    .no-cell {
        background: linear-gradient(135deg, #A0522D 0%, #D2691E 100%);
        color: white;
        font-weight: 700;
        border-radius: 6px;
        width: 32px;
        height: 32px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 13px;
    }

    .jenis-badge {
        background: #FFF0F0;
        color: #A0522D;
        padding: 0.4rem 0.8rem;
        border-radius: 6px;
        font-weight: 600;
        border: 1px solid #FFDDDD;
        display: inline-block;
    }

    .amount-text {
        font-weight: 700;
        color: #5D4037;
    }

    .empty-state {
        padding: 3rem;
        text-align: center;
    }

    .empty-state i {
        font-size: 3.5rem;
        color: #BDBDBD;
        margin-bottom: 1rem;
    }

    .empty-state p {
        color: #9E9E9E;
        font-weight: 500;
    }

    @media print {
        .filter-section,
        .no-print {
            display: none !important;
        }

        .report-container {
            box-shadow: none;
            padding: 1rem;
        }

        .table-report {
            font-size: 12px;
        }
    }
</style>

<div class="report-container">
    {{-- HEADER LAPORAN --}}
    <div class="report-header">
        <div class="school-logo">
            <img src="{{ asset('images/logo/logo_sekolah.png') }}" 
                 alt="Logo" 
                 style="width: 100%; height: 100%; object-fit: contain;">
        </div>
        <div class="school-name">MTs Mulia Insani</div>
        <div class="report-title">Laporan Dana Keluar</div>
        <div class="report-period">
            Periode: 
            @if(request('bulan') && request('tahun'))
                {{ \Carbon\Carbon::create(request('tahun'), request('bulan'))->translatedFormat('F Y') }}
            @elseif(request('tahun'))
                Tahun {{ request('tahun') }}
            @else
                Semua Periode
            @endif
        </div>
    </div>

    {{-- FILTER SECTION --}}
    <div class="filter-section no-print">
        <div class="filter-title">
            <i class="bi bi-funnel-fill"></i>
            Filter Laporan
        </div>
        <form method="GET" action="{{ route('laporan.kas_keluar') }}">
            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label fw-semibold" style="color: #5D4037; font-size: 13px;">
                        <i class="bi bi-calendar-month me-1"></i>
                        Bulan
                    </label>
                    <select name="bulan" class="form-select">
                        <option value="">Semua Bulan</option>
                        @for($i = 1; $i <= 12; $i++)
                            <option value="{{ $i }}" {{ request('bulan') == $i ? 'selected' : '' }}>
                                {{ \Carbon\Carbon::create()->month($i)->translatedFormat('F') }}
                            </option>
                        @endfor
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold" style="color: #5D4037; font-size: 13px;">
                        <i class="bi bi-calendar me-1"></i>
                        Tahun
                    </label>
                    <select name="tahun" class="form-select">
                        <option value="">Semua Tahun</option>
                        @for($year = date('Y'); $year >= date('Y') - 5; $year--)
                            <option value="{{ $year }}" {{ request('tahun') == $year ? 'selected' : '' }}>
                                {{ $year }}
                            </option>
                        @endfor
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label" style="opacity: 0;">Action</label>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-filter flex-fill">
                            <i class="bi bi-search me-1"></i>
                            Tampilkan
                        </button>
                        <button type="button" onclick="window.print()" class="btn btn-print">
                            <i class="bi bi-printer"></i>
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    {{-- TABLE LAPORAN --}}
    <div class="table-responsive">
        <table class="table table-report table-bordered">
            <thead>
                <tr>
                    <th width="5%" class="text-center">No</th>
                    <th width="15%">Tanggal</th>
                    <th width="35%">Keterangan</th>
                    <th width="20%">Jenis Pengeluaran</th>
                    <th width="25%" class="text-end">Jumlah (Rp)</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($kasKeluar as $item)
                    <tr>
                        <td class="text-center">
                            <span class="no-cell">{{ $loop->iteration }}</span>
                        </td>
                        <td>
                            <i class="bi bi-calendar3 me-1" style="color: #A0522D;"></i>
                            {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') }}
                        </td>
                        <td>{{ $item->keterangan }}</td>
                        <td>
                            <span class="jenis-badge">
                                <i class="bi bi-wallet2 me-1"></i>
                                {{ $item->nama_jenis_pengeluaran }}
                            </span>
                        </td>
                        <td class="text-end amount-text">
                            {{ number_format($item->jumlah, 0, ',', '.') }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="empty-state">
                            <i class="bi bi-inbox"></i>
                            <p class="mb-0">Tidak ada data dana keluar untuk periode ini</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
            @if($kasKeluar->count() > 0)
            <tfoot>
                <tr>
                    <td colspan="4" class="text-end">
                        <i class="bi bi-calculator me-2"></i>
                        TOTAL DANA KELUAR
                    </td>
                    <td class="text-end">
                        {{ number_format($total, 0, ',', '.') }}
                    </td>
                </tr>
            </tfoot>
            @endif
        </table>
    </div>

    {{-- SIGNATURE SECTION (for print) --}}
    <div style="margin-top: 3rem; display: none;" class="d-print-block">
        <div class="row">
            <div class="col-6">
                <div class="text-center">
                    <p style="margin-bottom: 4rem;">Mengetahui,<br>Kepala Sekolah</p>
                    <p style="border-bottom: 2px solid #000; display: inline-block; padding: 0 3rem;">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    </p>
                    <p>NIP. _______________</p>
                </div>
            </div>
            <div class="col-6">
                <div class="text-center">
                    <p style="margin-bottom: 4rem;">
                        {{ request('tahun') ? request('tahun') : date('Y') }}, 
                        {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}
                        <br>Bendahara
                    </p>
                    <p style="border-bottom: 2px solid #000; display: inline-block; padding: 0 3rem;">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    </p>
                    <p>NIP. _______________</p>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection