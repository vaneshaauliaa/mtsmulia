@extends ('layouts.app')

@section ('title', 'Pemasukan Dana')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Pemasukan Dana') }}</div>

                <div class="card-body">
                    <a href="{{ route('pemasukan_dana.create') }}" class="btn btn-primary mb-3">Tambah Pemasukan Dana</a>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Kode Transaksi</th>
                                <th>Sumber Dana</th>
                                <th>Jumlah</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pemasukanDana as $index => $pemasukan)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $pemasukan->tanggal->format('d-m-Y') }}</td>
                                <td>{{ $pemasukan->kode_transaksi }}</td>
                                <td>{{ $pemasukan->sumberDana->nama_sumber_dana }}</td>
                                <td>{{ number_format($pemasukan->jumlah, 2) }}</td>
                                <td>
                                    <a href="{{ route('pemasukan_dana.show', $pemasukan->id) }}" class="btn btn-sm btn-info">Detail</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection