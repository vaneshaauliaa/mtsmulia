@extends('layouts.app')

@section('title', 'Tambah Ekstrakurikuler')

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
        <a href="{{ route('ekstrakurikuler.index') }}" class="btn btn-light btn-sm me-3" style="border-radius: 10px;">
            <i class="bi bi-arrow-left"></i>
        </a>
        <div>
            <h2 class="mb-1 fw-bold">✨ Tambah Ekstrakurikuler</h2>
            <p class="mb-0 opacity-75">Lengkapi form untuk menambahkan ekstrakurikuler</p>
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
    <form action="{{ route('ekstrakurikuler.store') }}" method="POST" id="ekskulForm">
        @csrf
        
        <div class="form-section">
            <h5 class="section-title">
                <i class="bi bi-trophy-fill form-icon"></i>
                Informasi Ekstrakurikuler
            </h5>

            {{-- Kode Ekstrakurikuler --}}
            <div class="mb-4">
                <label for="id_ekstrakurikuler" class="form-label">
                    <i class="bi bi-upc-scan form-icon"></i>
                    Kode Ekstrakurikuler<span class="required">*</span>
                </label>
                <input type="text" 
                       class="form-control @error('id_ekstrakurikuler') is-invalid @enderror" 
                       id="id_ekstrakurikuler" 
                       name="id_ekstrakurikuler" 
                       value="{{ old('id_ekstrakurikuler') }}"
                       placeholder="Contoh: EKSKUL001, PRAMUKA, BASKET..."
                       required>
                @error('id_ekstrakurikuler')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <small class="text-muted">
                    <i class="bi bi-info-circle me-1"></i>
                    Kode unik untuk identifikasi ekstrakurikuler
                </small>
            </div>

            {{-- Nama Ekstrakurikuler --}}
            <div class="mb-4">
                <label for="nama_ekstrakurikuler" class="form-label">
                    <i class="bi bi-tag-fill form-icon"></i>
                    Nama Ekstrakurikuler<span class="required">*</span>
                </label>
                <input type="text" 
                       class="form-control @error('nama_ekstrakurikuler') is-invalid @enderror" 
                       id="nama_ekstrakurikuler" 
                       name="nama_ekstrakurikuler" 
                       value="{{ old('nama_ekstrakurikuler') }}"
                       placeholder="Contoh: Pramuka, Basket, Futsal, Tari, Musik..."
                       required>
                @error('nama_ekstrakurikuler')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        {{-- Action Buttons --}}
        <div class="btn-action-group">
            <a href="{{ route('ekstrakurikuler.index') }}" class="btn btn-cancel">
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
// Auto uppercase for kode ekstrakurikuler
document.getElementById('id_ekstrakurikuler').addEventListener('input', function(e) {
    this.value = this.value.toUpperCase();
});

// Form validation
document.getElementById('ekskulForm').addEventListener('submit', function(e) {
    const kodeEkskul = document.getElementById('id_ekstrakurikuler').value.trim();
    const namaEkskul = document.getElementById('nama_ekstrakurikuler').value.trim();

    if (kodeEkskul === '' || namaEkskul === '') {
        e.preventDefault();
        alert('Mohon lengkapi semua field yang wajib diisi!');
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