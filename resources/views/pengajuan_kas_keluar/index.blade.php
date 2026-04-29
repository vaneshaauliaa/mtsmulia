@extends('layouts.app')

@section('title', 'Pengajuan Dana Keluar')

@section('content')
<style>
    .page-header {
        background: linear-gradient(135deg, #A0522D 0%, #D2691E 100%);
        border-radius: 16px;
        padding: 2rem;
        margin-bottom: 2rem;
        color: white;
        box-shadow: 0 10px 30px rgba(160, 82, 45, 0.3);
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

    .btn-add {
        background: white;
        color: #A0522D;
        border: none;
        padding: 0.75rem 1.5rem;
        border-radius: 10px;
        font-weight: 600;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(255, 255, 255, 0.3);
    }
    
    .btn-add:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(255, 255, 255, 0.5);
        color: #A0522D;
    }

    .table-container {
        background: white;
        border-radius: 16px;
        padding: 0;
        box-shadow: 0 5px 25px rgba(0,0,0,0.08);
        overflow: hidden;
    }
    
    .table-modern {
        margin-bottom: 0;
        font-size: 14px;
    }
    
    .table-modern thead {
        background: linear-gradient(135deg, #A0522D 0%, #D2691E 100%);
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
        box-shadow: 0 3px 10px rgba(160, 82, 45, 0.1);
    }
    
    .table-modern tbody td {
        padding: 1rem 0.75rem;
        vertical-align: middle;
        border: none;
    }

    .no-cell {
        background: linear-gradient(135deg, #A0522D 0%, #D2691E 100%);
        color: white;
        font-weight: 700;
        border-radius: 8px;
        width: 35px;
        height: 35px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .badge-status {
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-weight: 600;
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .badge-pending {
        background: linear-gradient(135deg, #ffc107 0%, #ffb300 100%);
        color: #000;
    }

    .badge-approved {
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        color: white;
    }

    .badge-rejected {
        background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
        color: white;
    }

    .btn-detail {
        background: linear-gradient(135deg, #17a2b8 0%, #20c997 100%);
        color: white;
        padding: 0.4rem 0.8rem;
        border-radius: 8px;
        border: none;
        font-size: 0.875rem;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-detail:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(23, 162, 184, 0.4);
        color: white;
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
        color: #A0522D;
    }

    .empty-state p {
        color: #6D4C41;
        font-weight: 500;
    }

    .keterangan-text {
        max-width: 200px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        display: inline-block;
        color: #6D4C41;
    }

    .nominal-text {
        font-weight: 700;
        color: #A0522D;
        font-size: 14px;
    }
</style>

<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h2 class="mb-1 fw-bold">💸 Pengajuan Dana Keluar</h2>
            <p class="mb-0 opacity-75">Kelola pengajuan pengeluaran dana</p>
        </div>
        <a href="{{ route('pengajuan_kas_keluar.create') }}" class="btn btn-add">
            <i class="bi bi-plus-circle me-2"></i>Tambah Pengajuan
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

<div class="table-container">
    <table class="table table-modern align-middle mb-0">
        <thead>
            <tr class="text-center">
                <th width="5%">No</th>
                <th width="12%">Tanggal</th>
                <th width="20%">Jenis Pengeluaran</th>
                <th width="15%">Nominal</th>
                <th width="23%">Keterangan</th>
                <th width="15%">Status</th>
                <th width="10%">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data as $row)
            <tr class="text-center">
                <td>
                    <span class="no-cell">{{ $loop->iteration }}</span>
                </td>
                <td>
                    <i class="bi bi-calendar3 me-1" style="color: #A0522D;"></i>
                    {{ \Carbon\Carbon::parse($row->tanggal_pengajuan)->format('d M Y') }}
                </td>
                <td class="text-start">
                    <i class="bi bi-wallet2 me-2" style="color: #A0522D;"></i>
                    <span style="font-weight: 600; color: #5D4037;">
                        {{ $row->jenis_pengeluaran->nama_jenis_pengeluaran ?? '-' }}
                    </span>
                </td>
                <td class="nominal-text">
                    Rp {{ number_format($row->jumlah_pengajuan, 0, ',', '.') }}
                </td>
                <td class="text-start">
                    <span class="keterangan-text" title="{{ $row->keterangan }}">
                        <i class="bi bi-chat-left-text me-1" style="color: #9E9E9E;"></i>
                        {{ $row->keterangan ?? '-' }}
                    </span>
                </td>
                <td>
                    <span class="badge-status 
                        {{ $row->status == 'pending' ? 'badge-pending' : '' }}
                        {{ $row->status == 'approved' ? 'badge-approved' : '' }}
                        {{ $row->status == 'rejected' ? 'badge-rejected' : '' }}">
                        @if($row->status == 'pending')
                            <i class="bi bi-clock-history"></i>
                        @elseif($row->status == 'approved')
                            <i class="bi bi-check-circle"></i>
                        @else
                            <i class="bi bi-x-circle"></i>
                        @endif
                        {{ ucfirst($row->status) }}
                    </span>
                </td>
                <td>
                    <a href="{{ route('pengajuan_kas_keluar.show', $row->id) }}" 
                       class="btn-detail" 
                       title="Detail">
                        <i class="bi bi-eye"></i>
                    </a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="empty-state">
                    <i class="bi bi-inbox"></i>
                    <p class="mb-0">Belum ada data pengajuan</p>
                    <small class="text-muted">Mulai dengan menambahkan pengajuan pertama</small>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
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