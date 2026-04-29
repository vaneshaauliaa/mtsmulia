@extends('layouts.app')

@section('title', 'Tambah Chart of Accounts')

@section('content')
<style>
    .card-coa {
        background: #ffffff;
        border-radius: 16px;
        padding: 2rem;
        max-width: 700px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.08);
    }

    .card-header-coa {
        border-bottom: 1px solid #eee;
        margin-bottom: 1.5rem;
        padding-bottom: 1rem;
    }

    .card-header-coa h4 {
        margin: 0;
        font-weight: 700;
        color: #5D4037;
    }

    .card-header-coa p {
        margin: 0;
        font-size: 13px;
        color: #9E9E9E;
    }

    .form-label {
        font-weight: 600;
        color: #5D4037;
        font-size: 14px;
    }

    .form-control, .form-select {
        border-radius: 10px;
        padding: 0.7rem 0.9rem;
        border: 1.8px solid #ddd;
        font-size: 14px;
    }

    .form-control:focus, .form-select:focus {
        border-color: #8B4513;
        box-shadow: 0 0 0 0.15rem rgba(139,69,19,.15);
    }

    .btn-save {
        background: #8B4513;
        border: none;
        padding: 0.6rem 1.8rem;
        border-radius: 10px;
        color: white;
        font-weight: 600;
    }

    .btn-save:hover {
        background: #6f3610;
    }

    .btn-back {
        background: #f5f5f5;
        border: 1.8px solid #ddd;
        padding: 0.6rem 1.8rem;
        border-radius: 10px;
        font-weight: 600;
        color: #555;
    }
</style>

<div class="card-coa mx-auto">
    <div class="card-header-coa">
        <h4>Tambah Chart of Accounts</h4>
        <p>Form penambahan akun baru</p>
    </div>

    <form action="{{ route('coa.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Header Akun <span class="text-danger">*</span></label>
            <select name="header_akun" class="form-select" required>
                <option value="">-- Pilih Header --</option>
                <option value="1">Aset</option>
                <option value="2">Kewajiban</option>
                <option value="3">Ekuitas</option>
                <option value="4">Pendapatan</option>
                <option value="5">Beban</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Kode Akun <span class="text-danger">*</span></label>
            <input type="text" name="kode_akun" class="form-control" placeholder="Contoh: 1-1001" required>
        </div>

        <div class="mb-4">
            <label class="form-label">Nama Akun <span class="text-danger">*</span></label>
            <input type="text" name="nama_akun" class="form-control" placeholder="Contoh: Kas" required>
        </div>

        <div class="d-flex justify-content-end gap-2">
            <a href="{{ route('coa.index') }}" class="btn btn-back">Kembali</a>
            <button type="submit" class="btn btn-save">Simpan</button>
        </div>
    </form>
</div>

<script>
document.querySelector('[name="kode_akun"]').addEventListener('input', function(e){
    e.target.value = e.target.value.replace(/[^0-9-]/g,'');
});
</script>
@endsection
