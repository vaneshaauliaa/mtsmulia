@extends ('layouts.app')

@section ('title', 'Tambah Pemasukan Dana')

@section ('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Tambah Pemasukan Dana') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('pemasukan_dana.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="tanggal">Tanggal</label>
                            <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                        </div>
                        <div class="form-group">
                            <label for="kode_transaksi">Kode Transaksi</label>
                            <input type="text" class="form-control" id="kode_transaksi" name="kode_transaksi" required>
                        </div>
                        <div class="form-group">
                            <label for="sumber_dana_id">Sumber Dana</label>
                            <select class="form-control" id="sumber_dana_id" name="sumber_dana_id" required>
                                <option value="">Pilih Sumber Dana</option>
                                @foreach ($sumberDana as $sumber)
                                    <option value="{{ $sumber->id }}">{{ $sumber->nama_sumber_dana }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="jumlah">Jumlah</label>
                            <input type="number" step="0.01" class="form-control" id="jumlah" name="jumlah" required>
                        </div>
                        <div class="form-group">
                            <label for="keterangan">Keterangan</label>
                            <textarea class="form-control" id="keterangan" name="keterangan"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="bukti_transaksi">Bukti Transaksi</label>
                            <input type="file" class="form-control-file" id="bukti_transaksi" name="bukti_transaksi">
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection