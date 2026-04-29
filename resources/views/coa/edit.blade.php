@extends('layouts.app')

@section('title', 'Edit Chart Of Accounts')

@section('content')
<h4 class="mb-3 fw-semibold">Edit Chart of Accounts</h4>

<div class="p-3 rounded" style="background:transparent;">


    <div class="row">
        <div class="col text-center">
            <h1 class="mb-4">Edit Akun</h1>
        </div>
    </div>

    <form action="{{ route('coa.update', $coa->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="header_akun" class="form-label">Header Akun</label>
            <select class="form-control" id="header_akun" name="header_akun" required>
                <option value="">-- Pilih Header Akun --</option>
                <option value="1" {{ $coa->header_akun == 1 ? 'selected' : '' }}>Aset</option>
                <option value="2" {{ $coa->header_akun == 2 ? 'selected' : '' }}>Kewajiban</option>
                <option value="3" {{ $coa->header_akun == 3 ? 'selected' : '' }}>Ekuitas</option>
                <option value="4" {{ $coa->header_akun == 4 ? 'selected' : '' }}>Pendapatan</option>
                <option value="5" {{ $coa->header_akun == 5 ? 'selected' : '' }}>Beban</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="kode_akun" class="form-label">Kode Akun</label>
            <input 
                type="text" 
                class="form-control" 
                id="kode_akun" 
                name="kode_akun" 
                value="{{ $coa->kode_akun }}" 
                required>
        </div>

        <div class="mb-3">
            <label for="nama_akun" class="form-label">Nama Akun</label>
            <input 
                type="text" 
                class="form-control" 
                id="nama_akun" 
                name="nama_akun" 
                value="{{ $coa->nama_akun }}" 
                required>
        </div>

        <div class="mb-3">
            <label for="saldo_awal" class="form-label">Saldo Awal</label>
            <input 
                type="number" 
                class="form-control" 
                id="saldo_awal" 
                name="saldo_awal" 
                value="{{ $coa->saldo_awal }}" 
                required>
        </div>

        <button type="submit" class="btn btn-success">
            <i class=" "></i> Update
        </button>

        <a href="{{ route('coa.index') }}" class="btn btn-secondary">
            <i class=" "></i> Kembali
        </a>

    </form>
</div>
@endsection 
