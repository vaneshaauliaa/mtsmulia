@extends('layouts.app')

@section('title', 'Pencatatan Dana')

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
    
    .btn-add {
        background: linear-gradient(135deg, #8B4513 0%, #D2691E 100%);
        border: none;
        padding: 0.75rem 1.5rem;
        border-radius: 10px;
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
        padding: 1.5rem;
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
        transform: scale(1.01);
        box-shadow: 0 3px 10px rgba(139, 69, 19, 0.1);
    }
    
    .table-modern tbody td {
        padding: 1rem 0.75rem;
        vertical-align: middle;
        border: none;
    }
    
    .badge-dana-masuk {
        background: linear-gradient(135deg, #8B6914 0%, #CD853F 100%);
        padding: 0.5rem 1rem;
        border-radius: 20px;
        color: white;
        font-weight: 600;
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .badge-dana-keluar {
        background: linear-gradient(135deg, #A0522D 0%, #D2691E 100%);
        padding: 0.5rem 1rem;
        border-radius: 20px;
        color: white;
        font-weight: 600;
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .nominal-text {
        font-weight: 700;
        color: #2d3748;
        font-size: 15px;
    }
    
    .empty-state {
        padding: 3rem;
        text-align: center;
        color: #a0aec0;
    }
    
    .empty-state i {
        font-size: 4rem;
        margin-bottom: 1rem;
        opacity: 0.5;
    }
    
    .no-cell {
        background: linear-gradient(135deg, #8B4513 0%, #D2691E 100%);
        color: white;
        font-weight: 700;
        border-radius: 8px;
        width: 40px;
        height: 40px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }
</style>

<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h2 class="mb-1 fw-bold">💰 Pencatatan Dana</h2>
            <p class="mb-0 opacity-75">Kelola transaksi Dana masuk dan Dana keluar</p>
        </div>
        <a href="{{ route('pencatatan_kas.create') }}" class="btn btn-add">
            <i class="bi bi-plus-circle me-2"></i>Tambah Transaksi
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

<div class="table-container">
    <table class="table table-modern table-hover align-middle">
        <thead>
            <tr class="text-center">
                <th scope="col" style="width: 80px;">No.</th>
                <th scope="col">Tanggal</th>
                <th scope="col">Nama Transaksi</th>
                <th scope="col">Jenis</th>
                <th scope="col">Nominal</th>
                <th scope="col">Keterangan</th>
                <th scope="col" style="width: 120px;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data as $row)
            <tr class="text-center">
                <td>
                    <span class="no-cell">{{ $loop->iteration }}</span>
                </td>
                <td>
                    <i class="bi bi-calendar3 text-muted me-2"></i>
                    {{ \Carbon\Carbon::parse($row->tanggal)->format('d M Y') }}
                </td>
                <td class="fw-semibold text-dark">
                    @if($row->jenis_transaksi === 'kas_masuk')
                        <i class="bi bi-arrow-down-circle me-2" style="color: #8B6914;"></i>
                        {{ $row->sumberDana?->nama_sumber_dana ?? '-' }}
                    @else
                        <i class="bi bi-arrow-up-circle me-2" style="color: #A0522D;"></i>
                        {{ $row->jenisPengeluaran?->nama_jenis_pengeluaran ?? '-' }}
                    @endif
                </td>
                <td>
                    @if($row->jenis_transaksi === 'kas_masuk')
                        <span class="badge-dana-masuk">Dana Masuk</span>
                    @else
                        <span class="badge-dana-keluar">Dana Keluar</span>
                    @endif
                </td>
                <td class="nominal-text">
                    Rp {{ number_format($row->jumlah, 0, ',', '.') }}
                </td>
                <td class="text-muted">
                    {{ $row->keterangan ?? '-' }}
                </td>
                <td>
                    <a href="{{ route('pencatatan_kas.show', $row->id) }}" class="btn btn-sm btn-outline-primary">
                        <i class="bi bi-eye"></i> Detail 
                    </a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="empty-state">
                    <i class="bi bi-inbox"></i>
                    <p class="mb-0 fw-semibold">Tidak ada data pencatatan kas</p>
                    <small>Mulai dengan menambahkan transaksi pertama Anda</small>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection