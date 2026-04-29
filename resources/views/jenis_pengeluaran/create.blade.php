@extends('layouts.app')

@section('title', 'Tambah Jenis Pengeluaran Dana')

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

    .form-card {
        background: white;
        border-radius: 16px;
        padding: 2rem;
        max-width: 600px;
        box-shadow: 0 5px 25px rgba(0,0,0,0.08);
    }

    .form-label {
        font-weight: 600;
        color: #5D4037;
        font-size: 14px;
    }

    .form-control {
        border-radius: 10px;
        padding: 0.7rem 0.9rem;
        border: 2px solid #E0D5C7;
        font-size: 14px;
    }

    .form-control:focus {
        border-color: #A0522D;
        box-shadow: 0 0 0 0.15rem rgba(160,82,45,.2);
    }

    .btn-save {
        background: linear-gradient(135deg, #A0522D 0%, #D2691E 100%);
        border: none;
        padding: 0.6rem 1.8rem;
        border-radius: 10px;
        color: white;
        font-weight: 600;
        box-shadow: 0 4px 15px rgba(160, 82, 45, 0.3);
    }

    .btn-save:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(160, 82, 45, 0.4);
        color: white;
    }

    .btn-back {
        background: #f5f5f5;
        border: 2px solid #ddd;
        padding: 0.6rem 1.8rem;
        border-radius: 10px;
        font-weight: 600;
        color: #5D4037;
    }

    .btn-back:hover {
        background: #eee;
    }
</style>

{{-- HEADER --}}
<div class="page-header">
    <h2 class="mb-1 fw-bold">➕ Tambah Jenis Pengeluaran Dana</h2>
    <p class="mb-0 opacity-75">Masukkan data jenis pengeluaran dana baru</p>
</div>

{{-- FORM --}}
<div class="form-card mx-auto">
    <form action="{{ route('jenis_pengeluaran.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">
                Kode Jenis Pengeluaran <span class="text-danger">*</span>
            </label>
            <input type="text"
                   name="id_jenis_pengeluaran"
                   class="form-control @error('id_jenis_pengeluaran') is-invalid @enderror"
                   value="{{ old('id_jenis_pengeluaran') }}"
                   placeholder="Contoh: JPD-001"
                   required>
            @error('id_jenis_pengeluaran')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label class="form-label">
                Nama Jenis Pengeluaran Dana <span class="text-danger">*</span>
            </label>
            <input type="text"
                   name="nama_jenis_pengeluaran"
                   class="form-control @error('nama_jenis_pengeluaran') is-invalid @enderror"
                   value="{{ old('nama_jenis_pengeluaran') }}"
                   placeholder="Contoh: Pembelian ATK"
                   required>
            @error('nama_jenis_pengeluaran')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-flex justify-content-end gap-2">
            <a href="{{ route('jenis_pengeluaran.index') }}" class="btn btn-back">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
            <button type="submit" class="btn btn-save">
                <i class="bi bi-save"></i> Simpan
            </button>
        </div>
    </form>
</div>
@endsection
