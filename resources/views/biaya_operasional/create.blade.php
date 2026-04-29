@extends ('layouts.app')

@section('title', 'Tambah Biaya Operasional')

@section('content')
<div class="container">
    <h1 class="h3 mb-4">Tambah Biaya Operasional</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('biaya_operasional.store') }}" method="POST">
                @csrf
                <div class="form-group mb-3">
                    <label for="nama_biaya">Nama Biaya</label>
                    <input type="text" name="nama_biaya" id="nama_biaya" class="form-control" required>
                </div>

                <div class="form-group mb-3">
                    <label for="jumlah">Jumlah</label>
                    <input type="number" name="jumlah" id="jumlah" class="form-control" required>
                </div>
                <div class="form-group mb-3">
                    <label for="keterangan">Keterangan</label>
                    <textarea name="keterangan" id="keterangan" class="form-control" rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('biaya_operasional.index') }}" class="btn btn-secondary ms-2">Batal</a>
            </form>
        </div>
    </div>
</div>
