@extends('layouts.app')

@section('title', 'Edit Jenis Pengeluaran Dana')

@section('content')
<h4 class="mb-3 fw-semibold">Edit Jenis Pengeluaran Dana</h4>

<div class="p-3 rounded" style="background:transparent;">

    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('jenis_pengeluaran.update', $jenis_pengeluaran->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="id_jenis_pengeluaran" class="form-label">Id Jenis Pengeluaran Dana</label>
                            <input type="text" class="form-control" id="id_jenis_pengeluaran" name="id_jenis_pengeluaran" value="{{ $jenis_pengeluaran->id_jenis_pengeluaran }}" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="nama_jenis_pengeluaran" class="form-label">Nama Jenis Pengeluaran Dana</label>
                            <input type="text" class="form-control" id="nama_jenis_pengeluaran" name="nama_jenis_pengeluaran" value="{{ $jenis_pengeluaran->nama_jenis_pengeluaran }}" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="{{ route('jenis_pengeluaran.index') }}" class="btn btn-secondary">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection