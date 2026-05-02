@extends('layouts.app')

@section('title', 'Detail Perhitungan Gaji Guru')

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

    .btn-back {
        background: rgba(255,255,255,0.2);
        border: 1.5px solid rgba(255,255,255,0.5);
        padding: 0.5rem 1.25rem;
        border-radius: 8px;
        color: white;
        font-size: 13px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .btn-back:hover {
        background: rgba(255,255,255,0.35);
        color: white;
    }

    .detail-card {
        background: white;
        border-radius: 16px;
        box-shadow: 0 5px 25px rgba(0,0,0,0.08);
        overflow: hidden;
        margin-bottom: 1.25rem;
    }

    .detail-card-header {
        padding: 0.9rem 1.25rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-weight: 700;
        font-size: 13px;
        letter-spacing: 0.3px;
    }

    .detail-card-header.brown {
        background: linear-gradient(135deg, #8B4513 0%, #D2691E 100%);
        color: white;
    }

    .detail-card-header.green {
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        color: white;
    }

    .detail-card-header.yellow {
        background: linear-gradient(135deg, #ffc107 0%, #fd7e14 100%);
        color: #5D4037;
    }

    .detail-card-header.teal {
        background: linear-gradient(135deg, #17a2b8 0%, #20c997 100%);
        color: white;
    }

    .info-label {
        font-size: 11px;
        color: #9E9E9E;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.4px;
        margin-bottom: 4px;
    }

    .info-value {
        font-size: 15px;
        font-weight: 700;
        color: #5D4037;
        margin-bottom: 1rem;
    }

    .badge-jabatan {
        background: linear-gradient(135deg, #28a745, #20c997);
        color: white;
        padding: 0.4rem 1rem;
        border-radius: 8px;
        font-size: 12px;
        font-weight: 600;
        display: inline-block;
    }

    .badge-period {
        background: linear-gradient(135deg, #17a2b8, #20c997);
        color: white;
        padding: 0.5rem 1rem;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 600;
        display: inline-block;
    }

    .table-modern {
        width: 100%;
        border-collapse: collapse;
        font-size: 13px;
        margin-bottom: 0;
    }

    .table-modern thead th {
        padding: 0.75rem;
        background: #FFF8F0;
        color: #8B4513;
        font-weight: 700;
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: 0.4px;
        border-bottom: 2px solid #EDE0D4;
    }

    .table-modern tbody td {
        padding: 0.85rem 0.75rem;
        border-bottom: 0.5px solid #f5f0eb;
        color: #5D4037;
        vertical-align: middle;
    }

    .table-modern tbody tr:hover {
        background-color: #FFF8F0;
    }

    .table-modern tfoot td {
        padding: 0.9rem 0.75rem;
        background: linear-gradient(135deg, #FFF8F0, #FFE4B5);
        font-weight: 700;
        color: #8B4513;
        border-top: 2px solid #8B4513;
        font-size: 13px;
    }

    .no-cell {
        background: linear-gradient(135deg, #8B4513, #D2691E);
        color: white;
        font-weight: 700;
        border-radius: 6px;
        width: 28px;
        height: 28px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
    }

    .badge-jam {
        background: linear-gradient(135deg, #17a2b8, #20c997);
        color: white;
        padding: 0.3rem 0.7rem;
        border-radius: 6px;
        font-size: 12px;
        font-weight: 600;
    }

    .honor-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.9rem 0;
        border-bottom: 0.5px solid #f0e8de;
    }

    .honor-row:last-child {
        border-bottom: none;
    }

    .honor-label {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        color: #5D4037;
        font-weight: 600;
        font-size: 14px;
    }

    .honor-amount {
        font-weight: 600;
        color: #5D4037;
        font-size: 14px;
    }

    .total-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1rem 1.25rem;
        background: linear-gradient(135deg, #f9f3ec, #fde8c5);
        border-top: 2.5px solid #8B4513;
        margin: 0 -1.25rem -1.25rem;
    }

    .total-label {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-weight: 700;
        font-size: 15px;
        color: #8B4513;
    }

    .total-amount {
        font-size: 22px;
        font-weight: 700;
        color: #8B4513;
    }

    .ekskul-item {
        background: linear-gradient(135deg, #FFF8F0, #FFE4B5);
        border-left: 4px solid #D2691E;
        border-radius: 0 8px 8px 0;
        padding: 0.75rem 1rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        font-weight: 600;
        color: #5D4037;
        font-size: 14px;
    }

    .action-bar {
        background: white;
        border-radius: 16px;
        padding: 1rem 1.25rem;
        box-shadow: 0 5px 25px rgba(0,0,0,0.08);
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 1.25rem;
    }

    .btn-secondary-act {
        background: #F5F5F5;
        border: 2px solid #E0E0E0;
        padding: 0.55rem 1.25rem;
        border-radius: 8px;
        color: #5D4037;
        font-weight: 600;
        font-size: 13px;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .btn-secondary-act:hover {
        background: #EEEEEE;
        color: #5D4037;
    }

    .btn-print {
        background: linear-gradient(135deg, #8B4513, #D2691E);
        border: none;
        padding: 0.55rem 1.25rem;
        border-radius: 8px;
        color: white;
        font-weight: 600;
        font-size: 13px;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(139, 69, 19, 0.3);
    }

    .btn-print:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(139, 69, 19, 0.4);
    }

    @media print {
        .page-header, .action-bar { display: none !important; }
        .detail-card { box-shadow: none !important; border: 1px solid #ddd !important; }
    }
</style>

<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h2 class="mb-1 fw-bold">&#128202; Detail Perhitungan Gaji Guru</h2>
            <p class="mb-0 opacity-75">Rincian honor dan informasi mengajar guru</p>
        </div>
        <a href="{{ route('perhitungan_gaji_guru.index') }}" class="btn-back">
            <i class="bi bi-arrow-left me-1"></i> Kembali
        </a>
    </div>
</div>

@php
    $bulanNama = [
        1=>'Januari',2=>'Februari',3=>'Maret',4=>'April',
        5=>'Mei',6=>'Juni',7=>'Juli',8=>'Agustus',
        9=>'September',10=>'Oktober',11=>'November',12=>'Desember'
    ];
@endphp

<div class="row g-3">
    {{-- INFO GURU --}}
    <div class="col-lg-4">
        <div class="detail-card h-100">
            <div class="detail-card-header brown">
                <i class="bi bi-person-circle"></i> Informasi Guru
            </div>
            <div class="p-3">
                <div class="info-label">NIP</div>
                <div class="info-value">{{ $data->guru->id_guru ?? '-' }}</div>

                <div class="info-label">Nama Guru</div>
                <div class="info-value">{{ $data->guru->nama_guru ?? '-' }}</div>

                <div class="info-label">Jabatan</div>
                <div class="mb-3">
                    @if($data->guru && $data->guru->jabatan)
                        <span class="badge-jabatan">
                            <i class="bi bi-award me-1"></i>{{ $data->guru->jabatan->nama_jabatan }}
                        </span>
                    @else
                        <span style="color:#9E9E9E;font-size:13px;">Tidak ada jabatan</span>
                    @endif
                </div>

                <hr style="border:none;border-top:.5px solid #EDE0D4;margin:1rem 0;">

                <div class="info-label">Periode Gaji</div>
                <span class="badge-period">
                    <i class="bi bi-calendar-event me-1"></i>
                    {{ $bulanNama[$data->bulan] ?? '-' }} {{ $data->tahun }}
                </span>
            </div>
        </div>
    </div>

    {{-- KANAN: MENGAJAR + HONOR --}}
    <div class="col-lg-8 d-flex flex-column gap-3">

        {{-- DATA MENGAJAR --}}
        <div class="detail-card">
            <div class="detail-card-header green">
                <i class="bi bi-book"></i> Data Mengajar Bulan Ini
            </div>
            @if($data->guru && $data->guru->mengajar->count() > 0)
                <div class="table-responsive">
                    <table class="table-modern">
                        <thead>
                            <tr>
                                <th style="width:8%;text-align:center;">No</th>
                                <th>Mata Pelajaran</th>
                                <th style="width:18%;text-align:center;">Jumlah Jam</th>
                                <th style="width:22%;">Kelas</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $totalJam = 0; @endphp
                            @foreach($data->guru->mengajar as $index => $mengajar)
                            @php $totalJam += $mengajar->mata_pelajaran->jumlah_jam ?? 0; @endphp
                            <tr>
                                <td style="text-align:center;">
                                    <span class="no-cell">{{ $index + 1 }}</span>
                                </td>
                                <td style="font-weight:600;">{{ $mengajar->mata_pelajaran->nama_mata_pelajaran ?? '-' }}</td>
                                <td style="text-align:center;">
                                    <span class="badge-jam">{{ $mengajar->mata_pelajaran->jumlah_jam ?? 0 }} jam</span>
                                </td>
                                <td>{{ $mengajar->kelas->nama_kelas ?? '-' }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="2" style="text-align:right;">
                                    <i class="bi bi-calculator me-1"></i>Total Jam Mengajar:
                                </td>
                                <td style="text-align:center;">{{ $totalJam }} jam</td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            @else
                <div style="padding:3rem;text-align:center;">
                    <i class="bi bi-inbox" style="font-size:2.5rem;color:#D2691E;opacity:.5;display:block;margin-bottom:.75rem;"></i>
                    <p style="color:#8B4513;font-weight:500;margin:0;">Belum ada data mengajar</p>
                </div>
            @endif
        </div>

        {{-- RINCIAN HONOR --}}
        <div class="detail-card">
            <div class="detail-card-header yellow">
                <i class="bi bi-cash-stack"></i> Rincian Honor & Gaji
            </div>
            <div class="p-3">
                <div class="honor-row">
                    <div class="honor-label">
                        <i class="bi bi-book-half" style="color:#17a2b8;"></i> Honor Mengajar
                    </div>
                    <div class="honor-amount">Rp {{ number_format($data->honor_mengajar ?? 0, 0, ',', '.') }}</div>
                </div>
                <div class="honor-row">
                    <div class="honor-label">
                        <i class="bi bi-trophy" style="color:#ffc107;"></i> Honor Ekstrakurikuler
                    </div>
                    <div class="honor-amount">Rp {{ number_format($data->honor_ekstrakurikuler ?? 0, 0, ',', '.') }}</div>
                </div>
                <div class="honor-row">
                    <div class="honor-label">
                        <i class="bi bi-award" style="color:#D2691E;"></i> Tunjangan Jabatan
                    </div>
                    <div class="honor-amount">Rp {{ number_format($data->honor_jabatan ?? 0, 0, ',', '.') }}</div>
                </div>
            </div>
            <div class="total-row">
                <div class="total-label">
                    <i class="bi bi-wallet2"></i> TOTAL GAJI
                </div>
                <div class="total-amount">
                    Rp {{ number_format($data->total_gaji ?? 0, 0, ',', '.') }}
                </div>
            </div>
        </div>

    </div>
</div>

{{-- EKSTRAKURIKULER --}}
@if($data->guru && $data->guru->membina->count() > 0)
<div class="detail-card mt-3">
    <div class="detail-card-header teal">
        <i class="bi bi-stars"></i> Ekstrakurikuler yang Dibina
    </div>
    <div class="p-3">
        <div class="row g-2">
            @foreach($data->guru->membina as $membina)
            <div class="col-md-4">
                <div class="ekskul-item">
                    <i class="bi bi-trophy-fill" style="color:#D2691E;font-size:16px;"></i>
                    {{ $membina->ekstrakurikuler->nama_ekstrakurikuler ?? '-' }}
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endif

{{-- ACTION BAR --}}
<div class="action-bar">
    <a href="{{ route('perhitungan_gaji_guru.index') }}" class="btn-secondary-act">
        <i class="bi bi-arrow-left me-1"></i> Kembali ke Daftar
    </a>
    <button onclick="window.print()" class="btn-print">
        <i class="bi bi-printer me-1"></i> Cetak Slip Gaji
    </button>
</div>

@endsection