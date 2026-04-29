@extends('layouts.app')

@section('title', 'Tambah Jenis Penerimaan Dana')

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
    
    .form-container {
        background: white;
        border-radius: 16px;
        padding: 2rem;
        box-shadow: 0 5px 25px rgba(0,0,0,0.08);
        max-width: 700px;
    }
    
    .form-section {
        margin-bottom: 1.5rem;
        padding: 1.5rem;
        background: #FFF8F0;
        border-radius: 12px;
        border-left: 4px solid #8B4513;
    }
    
    .section-title {
        font-weight: 700;
        color: #8B4513;
        margin-bottom: 1rem;
        font-size: 16px;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .form-label {
        font-weight: 600;
        color: #5D4037;
        margin-bottom: 0.5rem;
        font-size: 14px;
    }
    
    .form-control {
        border: 2px solid #E0D5C7;
        border-radius: 10px;
        padding: 0.75rem 1rem;
        transition: all 0.3s ease;
        font-size: 14px;
    }
    
    .form-control:focus {
        border-color: #8B4513;
        box-shadow: 0 0 0 0.2rem rgba(139, 69, 19, 0.15);
        outline: none;
    }
    
    .form-control::placeholder {
        color: #BDBDBD;
    }
    
    .input-icon {
        position: relative;
    }
    
    .input-icon i {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: #8B4513;
    }
    
    .input-icon input {
        padding-left: 45px;
    }
    
    .btn-save {
        background: linear-gradient(135deg, #8B4513 0%, #D2691E 100%);
        border: none;
        padding: 0.75rem 2rem;
        border-radius: 10px;
        color: white;
        font-weight: 600;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(139, 69, 19, 0.3);
    }
    
    .btn-save:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(139, 69, 19, 0.4);
        color: white;
    }
    
    .btn-back {
        background: #F5F5F5;
        border: 2px solid #E0E0E0;
        padding: 0.75rem 2rem;
        border-radius: 10px;
        color: #5D4037;
        font-weight: 600;
        transition: all 0.3s ease;
    }
    
    .btn-back:hover {
        background: #EEEEEE;
        border-color: #BDBDBD;
        color: #5D4037;
        transform: translateY(-2px);
    }
    
    .required-mark {
        color: #D2691E;
        font-weight: 700;
    }

    .info-box {
        background: #E3F2FD;
        border-left: 4px solid #2196F3;
        padding: 1rem;
        border-radius: 8px;
        margin-top: 1rem;
    }

    .info-box i {
        color: #2196F3;
        margin-right: 0.5rem;
    }

    .info-box p {
        margin: 0;
        font-size: 13px;
        color: #1976D2;
    }
</style>

<div class="page-header">
    <div class="d-flex align-items-center">
        <i class="bi bi-plus-circle-fill me-3" style="font-size: 2rem;"></i>
        <div>
            <h2 class="mb-1 fw-bold">Tambah Jenis Penerimaan Dana</h2>
            <p class="mb-0 opacity-75">Tambahkan jenis sumber dana baru</p>
        </div>
    </div>
</div>

<div class="form-container">
    <form action="{{ route('sumber_dana.store') }}" method="POST">
        @csrf

        <div class="form-section">
            <div class="section-title">
                <i class="bi bi-info-circle-fill"></i>
                Informasi Jenis Penerimaan Dana
            </div>

            <div class="mb-3">
                <label for="id_sumber_dana" class="form-label">
                    <i class="bi bi-hash me-1"></i>
                    Kode Jenis Penerimaan Dana <span class="required-mark">*</span>
                </label>
                <div class="input-icon">
                    <i class="bi bi-code-square"></i>
                    <input type="text" 
                           class="form-control @error('id_sumber_dana') is-invalid @enderror" 
                           id="id_sumber_dana" 
                           name="id_sumber_dana" 
                           placeholder="Contoh: SD-001"
                           value="{{ old('id_sumber_dana') }}"
                           required>
                </div>
                @error('id_sumber_dana')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-0">
                <label for="nama_sumber_dana" class="form-label">
                    <i class="bi bi-pencil me-1"></i>
                    Nama Jenis Penerimaan Dana <span class="required-mark">*</span>
                </label>
                <div class="input-icon">
                    <i class="bi bi-cash-stack"></i>
                    <input type="text" 
                           class="form-control @error('nama_sumber_dana') is-invalid @enderror" 
                           id="nama_sumber_dana" 
                           name="nama_sumber_dana" 
                           placeholder="Contoh: Uang SPP"
                           value="{{ old('nama_sumber_dana') }}"
                           required>
                </div>
                @error('nama_sumber_dana')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="info-box">
                <i class="bi bi-lightbulb"></i>
                <strong>Tips:</strong>
                <p>Gunakan kode yang unik dan mudah diingat. Nama harus jelas dan deskriptif.</p>
            </div>
        </div>

        <div class="d-flex gap-2 mt-4">
            <button type="submit" class="btn btn-save">
                <i class="bi bi-save me-2"></i>Simpan
            </button>
            <a href="{{ route('sumber_dana.index') }}" class="btn btn-back">
                <i class="bi bi-arrow-left me-2"></i>Kembali
            </a>
        </div>
    </form>
</div>

@endsection