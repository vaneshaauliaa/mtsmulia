@extends('layouts.app')

@section('title', 'Data Guru')

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
        border-left: 4px solid #FFD700;
    }
    
    .alert-danger {
        background: linear-gradient(135deg, #A0522D 0%, #D2691E 100%);
        color: white;
        border-left: 4px solid #FF6B6B;
    }

    .card-modern {
        background: white;
        border-radius: 16px;
        box-shadow: 0 5px 25px rgba(0,0,0,0.08);
        border: none;
        overflow: hidden;
    }

    .card-header-modern {
        background: linear-gradient(135deg, #FDFBF7 0%, #FFF8F0 100%);
        border-bottom: 2px solid #E0D5C7;
        padding: 1.5rem;
    }

    .btn-add {
        background: linear-gradient(135deg, #8B4513 0%, #D2691E 100%);
        border: none;
        padding: 0.6rem 1.5rem;
        border-radius: 10px;
        color: white;
        font-weight: 600;
        font-size: 0.875rem;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(139, 69, 19, 0.3);
    }
    
    .btn-add:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(139, 69, 19, 0.4);
        color: white;
    }

    .search-box {
        position: relative;
    }

    .search-box .input-group-text {
        background: #FFF8F0;
        border: 2px solid #E0D5C7;
        border-right: none;
        color: #8B4513;
    }

    .search-box input {
        border: 2px solid #E0D5C7;
        border-left: none;
        padding: 0.6rem 1rem;
        font-size: 0.875rem;
    }

    .search-box input:focus {
        border-color: #8B4513;
        box-shadow: 0 0 0 0.2rem rgba(139, 69, 19, 0.15);
        outline: none;
    }

    .search-box input:focus + .input-group-text {
        border-color: #8B4513;
    }

    .table-modern {
        margin-bottom: 0;
        font-size: 0.875rem;
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
        font-size: 0.75rem;
        letter-spacing: 0.5px;
        vertical-align: middle;
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
        width: 35px;
        height: 35px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .nip-badge {
        background: #FFF8F0;
        color: #8B4513;
        padding: 0.4rem 0.8rem;
        border-radius: 8px;
        font-weight: 600;
        border: 2px solid #E0D5C7;
        display: inline-block;
    }

    .badge-jabatan {
        background: linear-gradient(135deg, #8B6914 0%, #CD853F 100%);
        color: white;
        padding: 0.4rem 0.8rem;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.75rem;
    }

    .badge-no-jabatan {
        background: #E0E0E0;
        color: #757575;
        padding: 0.4rem 0.8rem;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.75rem;
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

    .btn-detail {
        background: linear-gradient(135deg, #17a2b8 0%, #20c997 100%);
        color: white;
    }

    .btn-detail:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(23, 162, 184, 0.4);
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

    .card-footer-modern {
        background: linear-gradient(135deg, #FDFBF7 0%, #FFF8F0 100%);
        border-top: 2px solid #E0D5C7;
        padding: 1rem 1.5rem;
    }

    .footer-stats {
        font-size: 0.75rem;
        color: #6D4C41;
        font-weight: 500;
    }

    .footer-stats span {
        font-weight: 700;
        color: #8B4513;
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

    .no-result-state {
        padding: 3rem;
        text-align: center;
    }
    
    .no-result-state i {
        font-size: 3.5rem;
        margin-bottom: 1rem;
        color: #D2691E;
    }

    .no-result-state p {
        color: #6D4C41;
        font-weight: 500;
    }
</style>

<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h2 class="mb-1 fw-bold">👨‍🏫 Data Guru</h2>
            <p class="mb-0 opacity-75">Kelola data guru dan informasi jabatan</p>
        </div>
        <a href="{{ route('guru.create') }}" class="btn btn-add">
            <i class="bi bi-plus-circle me-2"></i>Tambah Guru
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

{{-- CARD TABLE --}}
<div class="card-modern">
    <div class="card-header-modern">
        <div class="row align-items-center g-3">
            <div class="col-lg-12">
                <div class="search-box">
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="bi bi-search"></i>
                        </span>
                        <input type="text" class="form-control" id="searchInput" 
                               placeholder="Cari berdasarkan NIP, Nama, No Telp, atau Jabatan...">
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="table-responsive">
        <table class="table table-modern align-middle mb-0" id="guruTable">
            <thead>
                <tr class="text-center">
                    <th width="8%">No</th>
                    <th width="17%">NIP</th>
                    <th width="25%">Nama Guru</th>
                    <th width="15%">No Telp</th>
                    <th width="15%">Jabatan</th>
                    <th width="20%">Aksi</th>
                </tr>
            </thead>
            <tbody id="tableBody">
                @php $no = 1; @endphp
                @forelse($guru as $g)
                <tr class="text-center">
                    <td>
                        <span class="no-cell">{{ $no++ }}</span>
                    </td>
                    <td>
                        <span class="nip-badge">{{ $g->id_guru }}</span>
                    </td>
                    <td class="text-start fw-semibold" style="color: #5D4037;">
                        <i class="bi bi-person-circle me-2" style="color: #8B4513;"></i>
                        {{ $g->nama_guru }}
                    </td>
                    <td style="color: #6D4C41;">
                        <i class="bi bi-telephone me-1" style="color: #D2691E;"></i>
                        {{ $g->no_telp }}
                    </td>
                    <td>
                        @if($g->jabatan)
                            <span class="badge-jabatan">
                                <i class="bi bi-award me-1"></i>
                                {{ $g->jabatan->nama_jabatan }}
                            </span>
                        @else
                            <span class="badge-no-jabatan">-</span>
                        @endif
                    </td>
                    <td>
                        <div class="btn-action-group">
                            <a href="{{ route('guru.show', $g->id) }}" class="btn-action btn-detail" title="Detail">
                                <i class="bi bi-eye"></i>
                            </a>
                            <a href="{{ route('guru.edit', $g->id) }}" class="btn-action btn-edit" title="Edit">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            <button type="button" class="btn-action btn-delete" title="Hapus" 
                                    onclick="confirmDelete('{{ route('guru.destroy', $g->id) }}')">
                                <i class="bi bi-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="empty-state">
                        <i class="bi bi-inbox"></i>
                        <p class="mb-0">Belum ada data guru</p>
                        <small class="text-muted">Mulai dengan menambahkan data guru pertama</small>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <div class="card-footer-modern">
        <div class="d-flex justify-content-between align-items-center">
            <div class="footer-stats">
                <i class="bi bi-people-fill me-1"></i>
                Total: <span id="totalData">{{ count($guru) }}</span> guru
            </div>
            <div class="footer-stats">
                <i class="bi bi-eye-fill me-1"></i>
                Menampilkan: <span id="visibleData">{{ count($guru) }}</span> data
            </div>
        </div>
    </div>
</div>

{{-- FORM DELETE HIDDEN --}}
<form id="deleteForm" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>

{{-- JAVASCRIPT --}}
<script>
// Search Functionality
document.getElementById('searchInput').addEventListener('keyup', function() {
    const searchValue = this.value.toLowerCase();
    const tableBody = document.getElementById('tableBody');
    const rows = tableBody.getElementsByTagName('tr');
    let visibleCount = 0;

    for (let i = 0; i < rows.length; i++) {
        const row = rows[i];
        const cells = row.getElementsByTagName('td');
        let found = false;

        // Skip empty state row
        if (cells.length === 1 && cells[0].getAttribute('colspan')) {
            continue;
        }

        // Search in NIP, Nama, No Telp, and Jabatan columns
        const nip = cells[1]?.textContent.toLowerCase() || '';
        const nama = cells[2]?.textContent.toLowerCase() || '';
        const noTelp = cells[3]?.textContent.toLowerCase() || '';
        const jabatan = cells[4]?.textContent.toLowerCase() || '';

        if (nip.includes(searchValue) || 
            nama.includes(searchValue) || 
            noTelp.includes(searchValue) || 
            jabatan.includes(searchValue)) {
            row.style.display = '';
            visibleCount++;
            // Update row number - keep the gradient badge
            const noCell = cells[0].querySelector('.no-cell');
            if (noCell) {
                noCell.textContent = visibleCount;
            }
        } else {
            row.style.display = 'none';
        }
    }

    // Update visible data count
    document.getElementById('visibleData').textContent = visibleCount;

    // Show "no results" message if no data found
    if (visibleCount === 0 && searchValue !== '') {
        let noResultRow = document.getElementById('noResultRow');
        if (!noResultRow) {
            noResultRow = tableBody.insertRow();
            noResultRow.id = 'noResultRow';
            const cell = noResultRow.insertCell(0);
            cell.colSpan = 6;
            cell.className = 'no-result-state';
            cell.innerHTML = `
                <i class="bi bi-search"></i>
                <p class="mb-0">Tidak ada data yang sesuai dengan pencarian "<strong>${searchValue}</strong>"</p>
                <small class="text-muted">Coba gunakan kata kunci lain</small>
            `;
        } else {
            const searchText = noResultRow.querySelector('strong');
            if (searchText) {
                searchText.textContent = searchValue;
            }
        }
    } else {
        const noResultRow = document.getElementById('noResultRow');
        if (noResultRow) {
            noResultRow.remove();
        }
    }
});

// Confirm Delete
function confirmDelete(url) {
    if (confirm('Apakah Anda yakin ingin menghapus data guru ini?\n\nData yang dihapus tidak dapat dikembalikan.')) {
        const form = document.getElementById('deleteForm');
        form.action = url;
        form.submit();
    }
}

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