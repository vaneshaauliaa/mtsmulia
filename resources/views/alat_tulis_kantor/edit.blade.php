@extends('layouts.app')

@section('title', 'Edit Alat Tulis Kantor')

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
        max-width: 600px;
        margin: 0 auto;
    }

    .form-label {
        font-weight: 600;
        color: #5D4037;
        font-size: 14px;
        margin-bottom: 0.5rem;
    }

    .form-control {
        border: 2px solid #E0D5C7;
        border-radius: 10px;
        padding: 0.75rem 1rem;
        font-size: 14px;
        transition: all 0.3s ease;
        background: #FDFBF7;
        color: #3E2723;
    }

    .form-control:focus {
        outline: none;
        border-color: #8B4513;
        background: white;
        box-shadow: 0 0 0 4px rgba(139, 69, 19, 0.1);
    }

    .form-control[readonly] {
        background: #F5EDE3;
        color: #8B4513;
        font-weight: 700;
        font-family: 'Courier New', monospace;
        cursor: not-allowed;
    }

    .form-control.is-invalid {
        border-color: #D2691E;
    }

    .invalid-feedback {
        color: #A0522D;
        font-size: 13px;
        font-weight: 500;
    }

    .input-icon-wrapper {
        position: relative;
    }

    .input-icon-wrapper i {
        position: absolute;
        left: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: #8B4513;
        font-size: 1rem;
        pointer-events: none;
    }

    .input-icon-wrapper .form-control {
        padding-left: 2.75rem;
    }

    .divider {
        border: none;
        border-top: 2px solid #F0E8DC;
        margin: 1.5rem 0;
    }

    .btn-back {
        background: white;
        border: 2px solid #E0D5C7;
        padding: 0.75rem 1.5rem;
        border-radius: 10px;
        color: #8B4513;
        font-weight: 600;
        font-size: 14px;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-back:hover {
        background: #FFF8F0;
        border-color: #8B4513;
        color: #8B4513;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(139, 69, 19, 0.15);
    }

    .btn-save {
        background: linear-gradient(135deg, #8B6914 0%, #CD853F 100%);
        border: none;
        padding: 0.75rem 2rem;
        border-radius: 10px;
        color: white;
        font-weight: 600;
        font-size: 14px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(139, 105, 20, 0.3);
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-save:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(139, 105, 20, 0.4);
        color: white;
    }

    .section-title {
        font-size: 13px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #8B4513;
        margin-bottom: 1.25rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .section-title::after {
        content: '';
        flex: 1;
        height: 2px;
        background: linear-gradient(to right, #E0D5C7, transparent);
        border-radius: 2px;
    }

    .edit-badge {
        background: rgba(255,255,255,0.2);
        border: 1px solid rgba(255,255,255,0.4);
        border-radius: 8px;
        padding: 0.4rem 0.9rem;
        font-size: 13px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
    }
</style>

<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h2 class="mb-1 fw-bold">✏️ Edit Alat Tulis Kantor</h2>
            <p class="mb-0 opacity-75">Perbarui informasi data ATK yang dipilih</p>
        </div>
        <span class="edit-badge">
            <i class="bi bi-upc-scan"></i>
            {{ $atk->kode_atk }}
        </span>
    </div>
</div>

<div class="form-container">
    <p class="section-title"><i class="bi bi-pencil-square"></i> Informasi ATK</p>

    <form action="{{ route('alat_tulis_kantor.update', $atk->id) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- Kode ATK --}}
        <div class="mb-4">
            <label class="form-label">Kode ATK</label>
            <div class="input-icon-wrapper">
                <i class="bi bi-upc-scan"></i>
                <input type="text"
                       name="kode_atk"
                       class="form-control"
                       value="{{ $atk->kode_atk }}"
                       readonly>
            </div>
            <small style="font-size:12px; color:#8B6914;">
                <i class="bi bi-info-circle me-1"></i>Kode ATK tidak dapat diubah
            </small>
        </div>

        {{-- Nama ATK --}}
        <div class="mb-4">
            <label class="form-label">Nama ATK <span style="color:#D2691E;">*</span></label>
            <div class="input-icon-wrapper">
                <i class="bi bi-pencil"></i>
                <input type="text"
                       name="nama_atk"
                       class="form-control @error('nama_atk') is-invalid @enderror"
                       placeholder="Masukkan nama alat tulis kantor..."
                       value="{{ old('nama_atk', $atk->nama_atk) }}"
                       required>
            </div>
            @error('nama_atk')
                <div class="invalid-feedback d-block mt-1">
                    <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                </div>
            @enderror
        </div>

        <hr class="divider">

        <div class="d-flex justify-content-between align-items-center">
            <a href="{{ route('alat_tulis_kantor.index') }}" class="btn-back">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
            <button type="submit" class="btn-save">
                <i class="bi bi-save"></i> Update
            </button>
        </div>
    </form>
</div>

@endsection