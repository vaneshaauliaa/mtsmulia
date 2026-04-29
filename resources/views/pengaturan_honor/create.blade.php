@extends('layouts.app')

@section('title', 'Tambah Pengaturan Honor')

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

    .form-card {
        background: white;
        border-radius: 16px;
        padding: 2rem;
        box-shadow: 0 5px 25px rgba(0,0,0,0.08);
        max-width: 800px;
        margin: 0 auto;
    }

    .form-label {
        color: #5D4037;
        font-weight: 600;
        font-size: 14px;
        margin-bottom: 0.5rem;
    }

    .form-label .required {
        color: #D2691E;
        margin-left: 2px;
    }

    .form-control, .form-select {
        border: 2px solid #E0D5C7;
        border-radius: 10px;
        padding: 0.75rem 1rem;
        font-size: 14px;
        transition: all 0.3s ease;
        background: #FDFBF7;
    }

    .form-control:focus, .form-select:focus {
        outline: none;
        border-color: #8B4513;
        background: white;
        box-shadow: 0 0 0 4px rgba(139, 69, 19, 0.1);
    }

    .form-control::placeholder {
        color: #B0A394;
        font-style: italic;
    }

    .input-group-text {
        background: linear-gradient(135deg, #8B4513 0%, #D2691E 100%);
        color: white;
        border: none;
        border-radius: 10px 0 0 10px;
        font-weight: 600;
    }

    .input-group .form-control {
        border-radius: 0 10px 10px 0;
    }

    .btn-submit {
        background: linear-gradient(135deg, #8B4513 0%, #D2691E 100%);
        border: none;
        padding: 0.75rem 2rem;
        border-radius: 10px;
        color: white;
        font-weight: 600;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(139, 69, 19, 0.3);
    }

    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(139, 69, 19, 0.4);
        color: white;
    }

    .btn-cancel {
        background: #E0D5C7;
        border: none;
        padding: 0.75rem 2rem;
        border-radius: 10px;
        color: #5D4037;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-cancel:hover {
        background: #D0C5B7;
        transform: translateY(-2px);
        color: #5D4037;
    }

    .alert-modern {
        border: none;
        border-radius: 12px;
        padding: 1rem 1.5rem;
        margin-bottom: 1.5rem;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }

    .alert-danger {
        background: linear-gradient(135deg, #A0522D 0%, #D2691E 100%);
        color: white;
    }

    .invalid-feedback {
        font-size: 13px;
        margin-top: 0.5rem;
    }

    .form-section {
        margin-bottom: 2rem;
    }

    .section-title {
        color: #8B4513;
        font-size: 16px;
        font-weight: 700;
        margin-bottom: 1.5rem;
        padding-bottom: 0.5rem;
        border-bottom: 2px solid #E0D5C7;
    }

    .form-icon {
        color: #8B4513;
        margin-right: 0.5rem;
    }

    .btn-action-group {
        display: flex;
        gap: 1rem;
        justify-content: flex-end;
        margin-top: 2rem;
        padding-top: 2rem;
        border-top: 2px solid #F5F5F5;
    }
</style>

<div class="page-header">
    <div class="d-flex align-items-center">
        <a href="{{ route('pengaturan_honor.index') }}" class="btn btn-light btn-sm me-3" style="border-radius: 10px;">
            <i class="bi bi-arrow-left"></i>
        </a>
        <div>
            <h2 class="mb-1 fw-bold">✨ Tambah Pengaturan Honor</h2>
            <p class="mb-0 opacity-75">Lengkapi form untuk menambahkan pengaturan honor</p>
        </div>
    </div>
</div>

{{-- ALERT ERROR --}}
@if($errors->any())
<div class="alert alert-danger alert-modern alert-dismissible fade show" role="alert">
    <i class="bi bi-exclamation-circle-fill me-2"></i>
    <strong>Terdapat kesalahan!</strong>
    <ul class="mb-0 mt-2">
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
</div>
@endif

<div class="form-card">
    <form action="{{ route('pengaturan_honor.store') }}" method="POST" id="honorForm">
        @csrf
        
        <div class="form-section">
            <h5 class="section-title">
                <i class="bi bi-award-fill form-icon"></i>
                Informasi Honor
            </h5>

            {{-- Nama Honor --}}
            <div class="mb-4">
                <label for="nama_honor" class="form-label">
                    <i class="bi bi-tag-fill form-icon"></i>
                    Nama Honor<span class="required">*</span>
                </label>
                <input type="text" 
                       class="form-control @error('nama_honor') is-invalid @enderror" 
                       id="nama_honor" 
                       name="nama_honor" 
                       value="{{ old('nama_honor') }}"
                       placeholder="Contoh: Honor Mengajar, Honor Wali Kelas, Honor Piket..."
                       required>
                @error('nama_honor')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Jumlah Honor --}}
            <div class="mb-4">
                <label for="jumlah_honor" class="form-label">
                    <i class="bi bi-cash-stack form-icon"></i>
                    Honor<span class="required">*</span>
                </label>
                <div class="input-group">
                    <span class="input-group-text">Rp</span>
                    <input type="number" 
                           class="form-control @error('jumlah_honor') is-invalid @enderror" 
                           id="jumlah_honor" 
                           name="jumlah_honor" 
                           value="{{ old('jumlah_honor') }}"
                           placeholder="Masukkan nominal honor..."
                           min="0"
                           step="1000"
                           required>
                    @error('jumlah_honor')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <small class="text-muted">
                    <i class="bi bi-info-circle me-1"></i>
                    Format: Angka tanpa titik atau koma (per jam)
                </small>
            </div>
        </div>

        {{-- Action Buttons --}}
        <div class="btn-action-group">
            <a href="{{ route('pengaturan_honor.index') }}" class="btn btn-cancel">
                <i class="bi bi-x-circle me-2"></i>Batal
            </a>
            <button type="submit" class="btn btn-submit">
                <i class="bi bi-check-circle me-2"></i>Simpan Data
            </button>
        </div>
    </form>
</div>

{{-- JAVASCRIPT --}}
<script>
// Auto-format currency input
document.getElementById('jumlah_honor').addEventListener('input', function(e) {
    let value = this.value.replace(/[^\d]/g, '');
    this.value = value;
});

// Form validation
document.getElementById('honorForm').addEventListener('submit', function(e) {
    const namaHonor = document.getElementById('nama_honor').value.trim();
    const jumlahHonor = document.getElementById('jumlah_honor').value.trim();

    if (namaHonor === '' || jumlahHonor === '') {
        e.preventDefault();
        alert('Mohon lengkapi semua field yang wajib diisi!');
        return false;
    }

    if (parseInt(jumlahHonor) < 0) {
        e.preventDefault();
        alert('Jumlah honor tidak boleh bernilai negatif!');
        return false;
    }
});

// Auto-hide alerts
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