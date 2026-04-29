@extends('layouts.app')

@section('title', 'Jabatan')

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

    .jabatan-name {
        color: #5D4037;
        font-weight: 600;
        font-size: 14px;
    }

    .tunjangan-badge {
        background: #FFF8F0;
        color: #8B4513;
        padding: 0.5rem 1rem;
        border-radius: 8px;
        font-weight: 700;
        border: 2px solid #E0D5C7;
        font-size: 14px;
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

    .search-box {
        position: relative;
        margin-bottom: 1.5rem;
    }

    .search-box input {
        width: 100%;
        max-width: 400px;
        padding: 0.75rem 1rem 0.75rem 3rem;
        border: 2px solid #E0D5C7;
        border-radius: 12px;
        font-size: 14px;
        transition: all 0.3s ease;
        background: #FDFBF7;
    }

    .search-box input:focus {
        outline: none;
        border-color: #8B4513;
        background: white;
        box-shadow: 0 0 0 4px rgba(139, 69, 19, 0.1);
    }

    .search-box i {
        position: absolute;
        left: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: #8B4513;
        font-size: 1.1rem;
    }

    .btn-action {
        padding: 0.4rem 0.8rem;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 600;
        transition: all 0.3s ease;
        border: none;
        margin: 0 0.2rem;
    }

    .btn-edit {
        background: linear-gradient(135deg, #8B6914 0%, #CD853F 100%);
        color: white;
    }

    .btn-edit:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(139, 105, 20, 0.3);
        color: white;
    }

    .btn-delete {
        background: linear-gradient(135deg, #A0522D 0%, #D2691E 100%);
        color: white;
    }

    .btn-delete:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(160, 82, 45, 0.3);
        color: white;
    }
</style>

<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h2 class="mb-1 fw-bold">💼 Data Jabatan</h2>
            <p class="mb-0 opacity-75">Kelola daftar jabatan dan tunjangan</p>
        </div>
        <a href="{{ route('jabatan.create') }}" class="btn btn-add">
            <i class="bi bi-plus-circle me-2"></i>Tambah Data Jabatan
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

{{-- SEARCH BOX --}}
<div class="search-box">
    <i class="bi bi-search"></i>
    <input type="text" 
           id="searchInput" 
           placeholder="Cari berdasarkan nama jabatan atau tunjangan...">
</div>

{{-- TABLE --}}
<div class="table-container">
    <table class="table table-modern align-middle mb-0" id="jabatanTable">
        <thead>
            <tr class="text-center">
                <th width="10%">No</th>
                <th width="40%">Nama Jabatan</th>
                <th width="30%">Tunjangan Jabatan</th>
                <th width="20%">Aksi</th>
            </tr>
        </thead>
        <tbody id="tableBody">
            @php $no = 1; @endphp
            @forelse($jabatan as $item)
            <tr class="text-center">
                <td>
                    <span class="no-cell">{{ $no++ }}</span>
                </td>
                <td class="text-start">
                    <span class="jabatan-name">
                        <i class="bi bi-briefcase-fill me-2" style="color: #8B4513;"></i>
                        {{ $item->nama_jabatan }}
                    </span>
                </td>
                <td>
                    <span class="tunjangan-badge">
                        Rp {{ number_format($item->honor_jabatan, 0, ',', '.') }}
                    </span>
                </td>
                <td>
                    <a href="{{ route('jabatan.edit', $item->id) }}" class="btn btn-edit btn-action">
                        <i class="bi bi-pencil-square"></i> Edit
                    </a>
                    <form action="{{ route('jabatan.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-delete btn-action">
                            <i class="bi bi-trash"></i> Hapus
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="empty-state">
                    <i class="bi bi-inbox"></i>
                    <p class="mb-0">Belum ada data jabatan</p>
                    <small class="text-muted">Mulai dengan menambahkan jabatan pertama</small>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

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

        // Skip empty state row
        if (cells.length === 1 && cells[0].getAttribute('colspan')) {
            continue;
        }

        // Search in Nama Jabatan and Tunjangan columns
        const nama = cells[1]?.textContent.toLowerCase() || '';
        const tunjangan = cells[2]?.textContent.toLowerCase() || '';

        if (nama.includes(searchValue) || tunjangan.includes(searchValue)) {
            row.style.display = '';
            visibleCount++;
            // Update row number
            const noCell = cells[0].querySelector('.no-cell');
            if (noCell) {
                noCell.textContent = visibleCount;
            }
        } else {
            row.style.display = 'none';
        }
    }

    // Show "no results" message if no data found
    if (visibleCount === 0 && searchValue !== '') {
        let noResultRow = document.getElementById('noResultRow');
        if (!noResultRow) {
            noResultRow = tableBody.insertRow();
            noResultRow.id = 'noResultRow';
            const cell = noResultRow.insertCell(0);
            cell.colSpan = 4;
            cell.className = 'empty-state';
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