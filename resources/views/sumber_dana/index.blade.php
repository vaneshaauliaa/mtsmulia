@extends('layouts.app')

@section('title', 'Jenis Penerimaan Dana')

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
        padding: 0;
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
        transform: scale(1.005);
        box-shadow: 0 3px 10px rgba(139, 69, 19, 0.1);
    }
    
    .table-modern tbody td {
        padding: 1rem 0.75rem;
        vertical-align: middle;
        border: none;
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

    .code-badge {
        background: #FFF8F0;
        color: #8B4513;
        padding: 0.5rem 1rem;
        border-radius: 8px;
        font-weight: 700;
        border: 2px solid #E0D5C7;
        font-family: 'Courier New', monospace;
    }

    .name-text {
        color: #5D4037;
        font-weight: 600;
    }

    .btn-action-group {
        display: flex;
        gap: 0.5rem;
        justify-content: center;
    }

    .btn-action {
        padding: 0.4rem 0.8rem;
        border-radius: 8px;
        border: none;
        font-size: 0.875rem;
        font-weight: 600;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .btn-edit {
        background: linear-gradient(135deg, #ffc107 0%, #ff9800 100%);
        color: white;
    }

    .btn-edit:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(255, 193, 7, 0.4);
    }

    .btn-delete {
        background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
        color: white;
    }

    .btn-delete:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(220, 53, 69, 0.4);
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
        color: #8B4513;
    }

    .empty-state p {
        color: #6D4C41;
        font-weight: 500;
    }
</style>

<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h2 class="mb-1 fw-bold">💰 Jenis Penerimaan Dana</h2>
            <p class="mb-0 opacity-75">Kelola jenis sumber dana yang masuk</p>
        </div>
        <a href="{{ route('sumber_dana.create') }}" class="btn btn-add">
            <i class="bi bi-plus-circle me-2"></i>Tambah Jenis
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
    <table class="table table-modern align-middle mb-0">
        <thead>
            <tr class="text-center">
                <th width="10%">No</th>
                <th width="25%">Kode</th>
                <th width="45%">Nama Jenis Penerimaan Dana</th>
                <th width="20%">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @php $no = 1; @endphp
            @forelse($sumber_dana as $item)
            <tr class="text-center">
                <td>
                    <span class="no-cell">{{ $no++ }}</span>
                </td>
                <td>
                    <span class="code-badge">{{ $item->id_sumber_dana }}</span>
                </td>
                <td class="text-start">
                    <span class="name-text">
                        <i class="bi bi-cash-stack me-2" style="color: #8B4513;"></i>
                        {{ $item->nama_sumber_dana }}
                    </span>
                </td>
                <td>
                    <div class="btn-action-group">
                        <a href="{{ route('sumber_dana.edit', $item->id) }}" 
                           class="btn-action btn-edit" 
                           title="Edit">
                            <i class="bi bi-pencil-square"></i>
                        </a>
                        <form action="{{ route('sumber_dana.destroy', $item->id) }}" 
                              method="POST" 
                              class="d-inline" 
                              onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?\n\nData yang dihapus tidak dapat dikembalikan.');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="btn-action btn-delete" 
                                    title="Hapus">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="empty-state">
                    <i class="bi bi-inbox"></i>
                    <p class="mb-0">Belum ada data jenis penerimaan dana</p>
                    <small class="text-muted">Mulai dengan menambahkan jenis pertama</small>
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