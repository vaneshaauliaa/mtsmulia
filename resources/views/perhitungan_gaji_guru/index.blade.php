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
    
    .alert-success {
        background: linear-gradient(135deg, #8B6914 0%, #CD853F 100%);
        color: white;
    }
    
    .alert-danger {
        background: linear-gradient(135deg, #A0522D 0%, #D2691E 100%);
        color: white;
    }

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
        font-size: 1.1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .form-label {
        font-weight: 600;
        color: #5D4037;
        margin-bottom: 0.5rem;
        font-size: 13px;
    }

    .form-control, .form-select {
        border: 2px solid #E0D5C7;
        border-radius: 8px;
        padding: 0.6rem 0.9rem;
        font-size: 14px;
        transition: all 0.3s ease;
    }

    .form-control:focus, .form-select:focus {
        border-color: #8B4513;
        box-shadow: 0 0 0 0.2rem rgba(139, 69, 19, 0.15);
        outline: none;
    }

    .btn-filter {
        background: linear-gradient(135deg, #17a2b8 0%, #20c997 100%);
        border: none;
        padding: 0.6rem 1.5rem;
        border-radius: 8px;
        color: white;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-filter:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(23, 162, 184, 0.4);
        color: white;
    }

    .btn-reset {
        background: #F5F5F5;
        border: 2px solid #E0E0E0;
        padding: 0.6rem 1.5rem;
        border-radius: 8px;
        color: #5D4037;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-reset:hover {
        background: #EEEEEE;
        border-color: #BDBDBD;
        color: #5D4037;
    }

    .btn-add {
        background: linear-gradient(135deg, #8B4513 0%, #D2691E 100%);
        border: none;
        padding: 0.6rem 1.5rem;
        border-radius: 8px;
        color: white;
        font-weight: 600;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(139, 69, 19, 0.3);
    }
    
    .btn-add:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(139, 69, 19, 0.4);
        color: white;
    }

    .table-container {
        background: white;
        border-radius: 16px;
        box-shadow: 0 5px 25px rgba(0,0,0,0.08);
        overflow: hidden;
    }
    
    .table-modern {
        margin-bottom: 0;
        font-size: 14px;
    }
    
    .table-modern thead {
        background: linear-gradient(135deg, #8B4513 0%, #D2691E 100%);
        color: white;
    }
    
    .table-modern thead th {
        border: none;
        padding: 1rem 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 12px;
        letter-spacing: 0.5px;
    }
    
    .table-modern tbody tr {
        transition: all 0.3s ease;
        border-bottom: 1px solid #f0f0f0;
    }
    
    .table-modern tbody tr:hover {
        background-color: #FFF8F0;
        transform: scale(1.002);
    }
    
    .table-modern tbody td {
        padding: 1rem 0.75rem;
        vertical-align: middle;
        border: none;
    }

    .table-modern tfoot {
        background: linear-gradient(135deg, #FFF8F0 0%, #FFE4B5 100%);
        font-weight: 700;
    }

    .table-modern tfoot td {
        padding: 1.2rem 0.75rem;
        color: #8B4513;
        font-size: 15px;
        border-top: 3px solid #8B4513;
    }

    .no-cell {
        background: linear-gradient(135deg, #8B4513 0%, #D2691E 100%);
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

    .badge-period {
        background: linear-gradient(135deg, #17a2b8 0%, #20c997 100%);
        color: white;
        padding: 0.5rem 1rem;
        border-radius: 8px;
        font-weight: 600;
        font-size: 12px;
    }

    .guru-name {
        font-weight: 600;
        color: #5D4037;
        font-size: 14px;
        margin-bottom: 0.25rem;
    }

    .guru-jabatan {
        color: #9E9E9E;
        font-size: 11px;
        font-weight: 500;
    }

    .amount-text {
        font-weight: 600;
        color: #5D4037;
    }

    .total-amount {
        font-weight: 700;
        color: #8B6914;
        font-size: 16px;
    }

    .btn-detail {
        background: linear-gradient(135deg, #17a2b8 0%, #20c997 100%);
        color: white;
        padding: 0.4rem 1rem;
        border-radius: 8px;
        border: none;
        font-size: 13px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-detail:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(23, 162, 184, 0.4);
        color: white;
    }

    .empty-state {
        padding: 4rem 2rem;
        text-align: center;
    }
    
    .empty-state i {
        font-size: 4rem;
        color: #8B4513;
        opacity: 0.5;
        margin-bottom: 1rem;
    }

    .empty-state p {
        color: #6D4C41;
        font-weight: 500;
        margin-bottom: 1.5rem;
    }

    .stats-row {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1rem;
        margin-bottom: 2rem;
    }

    .stat-box {
        background: linear-gradient(135deg, #FFF8F0 0%, #FFE4B5 100%);
        padding: 1.25rem;
        border-radius: 12px;
        border-left: 4px solid #8B4513;
    }

    .stat-label {
        font-size: 12px;
        color: #8B4513;
        font-weight: 600;
        text-transform: uppercase;
        margin-bottom: 0.5rem;
    }

    .stat-value {
        font-size: 1.5rem;
        font-weight: 700;
        color: #5D4037;
    }
</style>

<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h2 class="mb-1 fw-bold">💰 Perhitungan Gaji Guru</h2>
            <p class="mb-0 opacity-75">Kelola perhitungan gaji dan honor guru</p>
        </div>  
        <a href="{{ route('perhitungan_gaji_guru.create') }}" class="btn btn-add">
            <i class="bi bi-plus-circle me-2"></i>Tambah Perhitungan
        </a>
    </div>
</div>

{{-- ALERT SUCCESS --}}
@if(session('success'))
<div class="alert alert-success alert-modern alert-dismissible fade show" role="alert">
    <i class="bi bi-check-circle-fill me-2"></i>
    {{ session('success') }}
    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
</div>
@endif

{{-- ALERT ERROR --}}
@if(session('error'))
<div class="alert alert-danger alert-modern alert-dismissible fade show" role="alert">
    <i class="bi bi-exclamation-circle-fill me-2"></i>
    {{ session('error') }}
    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
</div>
@endif

{{-- STATS --}}
@if($data->count() > 0)
<div class="stats-row">
    <div class="stat-box">
        <div class="stat-label">
            <i class="bi bi-people-fill me-1"></i>
            Total Guru
        </div>
        <div class="stat-value">{{ $data->unique('id_guru')->count() }}</div>
    </div>
    <div class="stat-box">
        <div class="stat-label">
            <i class="bi bi-calculator me-1"></i>
            Total Perhitungan
        </div>
        <div class="stat-value">{{ $data->count() }}</div>
    </div>
    <div class="stat-box">
        <div class="stat-label">
            <i class="bi bi-cash-stack me-1"></i>
            Total Honor
        </div>
        <div class="stat-value">Rp {{ number_format($data->sum('total_gaji') / 1000000, 1) }}jt</div>
    </div>
</div>
@endif

{{-- FILTER --}}
<div class="filter-card">
    <div class="filter-header">
        <i class="bi bi-funnel-fill"></i>
        Filter Data
    </div>
    <form method="GET" action="{{ route('perhitungan_gaji_guru.index') }}">
        <div class="row g-3">
            <div class="col-md-3">
                <label class="form-label">
                    <i class="bi bi-person me-1"></i>
                    Guru
                </label>
                <select name="guru_filter" class="form-select">
                    <option value="">Semua Guru</option>
                    @foreach(\App\Models\guru::all() as $g)
                        <option value="{{ $g->id_guru }}" {{ request('guru_filter') == $g->id_guru ? 'selected' : '' }}>
                            {{ $g->nama_guru }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label">
                    <i class="bi bi-calendar-month me-1"></i>
                    Bulan
                </label>
                <select name="bulan_filter" class="form-select">
                    <option value="">Semua Bulan</option>
                    @php
                    $bulanList = [
                        1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
                        5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
                        9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
                    ];
                    @endphp
                    @foreach($bulanList as $key => $nama)
                        <option value="{{ $key }}" {{ request('bulan_filter') == $key ? 'selected' : '' }}>
                            {{ $nama }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <label class="form-label">
                    <i class="bi bi-calendar me-1"></i>
                    Tahun
                </label>
                <input type="number" name="tahun_filter" class="form-control" 
                       value="{{ request('tahun_filter') }}" placeholder="2024">
            </div>
            <div class="col-md-4 d-flex align-items-end gap-2">
                <button type="submit" class="btn btn-filter">
                    <i class="bi bi-search me-1"></i> Tampilkan
                </button>
                <a href="{{ route('perhitungan_gaji_guru.index') }}" class="btn btn-reset">
                    <i class="bi bi-arrow-clockwise me-1"></i> Reset
                </a>
            </div>
        </div>
    </form>
</div>

{{-- TABLE --}}
<div class="table-container">
    @if($data->count() > 0)
        <div class="table-responsive">
            <table class="table table-modern align-middle mb-0">
                <thead>
                    <tr>
                        <th width="5%" class="text-center">No</th>
                        <th width="20%">Guru</th>
                        <th width="10%" class="text-center">Periode</th>
                        <th width="13%" class="text-end">Honor Mengajar</th>
                        <th width="13%" class="text-end">Honor Ekskul</th>
                        <th width="13%" class="text-end">Tunjangan Jabatan</th>
                        <th width="16%" class="text-end">Total Honor</th>
                        <th width="10%" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $bulanNama = [
                            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
                            5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
                            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
                        ];
                    @endphp
                    @foreach($data as $index => $item)
                        <tr>
                            <td class="text-center">
                                <span class="no-cell">{{ $index + 1 }}</span>
                            </td>
                            <td>
                                <div class="guru-name">
                                    <i class="bi bi-person-circle me-1" style="color: #8B4513;"></i>
                                    {{ $item->guru->nama_guru ?? '-' }}
                                </div>
                                @if($item->guru && $item->guru->jabatan)
                                    <div class="guru-jabatan">
                                        {{ $item->guru->jabatan->nama_jabatan }}
                                    </div>
                                @endif
                            </td>
                            <td class="text-center">
                                <span class="badge-period">
                                    <i class="bi bi-calendar3 me-1"></i>
                                    {{ $bulanNama[$item->bulan] ?? '-' }} {{ $item->tahun }}
                                </span>
                            </td>
                            <td class="text-end amount-text">
                                Rp {{ number_format($item->honor_mengajar ?? 0, 0, ',', '.') }}
                            </td>
                            <td class="text-end amount-text">
                                Rp {{ number_format($item->honor_ekstrakurikuler ?? 0, 0, ',', '.') }}
                            </td>
                            <td class="text-end amount-text">
                                Rp {{ number_format($item->honor_jabatan ?? 0, 0, ',', '.') }}
                            </td>
                            <td class="text-end total-amount">
                                Rp {{ number_format($item->total_gaji ?? 0, 0, ',', '.') }}
                            </td>
                            <td class="text-center">
                                <a href="{{ route('perhitungan_gaji_guru.show', $item->id) }}" 
                                   class="btn-detail">
                                    <i class="bi bi-eye me-1"></i> Detail
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="6" class="text-end">
                            <i class="bi bi-calculator me-2"></i>
                            TOTAL KESELURUHAN
                        </td>
                        <td class="text-end" style="font-size: 17px; color: #8B4513;">
                            Rp {{ number_format($data->sum('total_gaji'), 0, ',', '.') }}
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
            <a href="{{ route('perhitungan_gaji_guru.create') }}" class="btn btn-add">
                <i class="bi bi-plus-circle me-2"></i> Tambah Data Pertama
            </a>
        </div>
    @endif
</div>

<script>
// Auto-hide alerts after 5 seconds
document.addEventListener('DOMContentLoaded', function() {
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(function(alert) {
        setTimeout(function() {
            const bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        }, 5000);
    });
});
</script>

@endsection