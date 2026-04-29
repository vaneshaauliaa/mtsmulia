@extends ('layouts.app')

@section ('title', 'Detail Pemasukan Dana')

@section ('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Detail Pemasukan Dana') }}</div>

                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th width="30%">Tanggal</th>
                            <td>{{ $pemasukan_dana->tanggal->format('d-m-Y') }}</td>
                        </tr>
                        <tr>
                            <th>Kode Transaksi</th>
                            <td>{{ $pemasukan_dana->kode_transaksi }}</td>
                        </tr>
                        <tr>
                            <th>Sumber Dana</th>
                            <td>{{ $pemasukan_dana->sumberDana->nama_sumber_dana }}</td>
                        </tr>
                        <tr>
                            <th>Jumlah</th>
                            <td>Rp {{ number_format($pemasukan_dana->jumlah, 2, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <th>Keterangan</th>
                            <td>{{ $pemasukan_dana->keterangan ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Bukti Transaksi</th>
                            <td>
                                @if ($pemasukan_dana->bukti_transaksi)
                                    @php
                                        $extension = pathinfo($pemasukan_dana->bukti_transaksi, PATHINFO_EXTENSION);
                                    @endphp
                                    @if (in_array(strtolower($extension), ['jpg', 'jpeg', 'png']))
                                        <img src="{{ asset('storage/' . $pemasukan_dana->bukti_transaksi) }}" alt="Bukti Transaksi" class="img-fluid" style="max-width: 400px;">
                                    @elseif (strtolower($extension) === 'pdf')
                                        <a href="{{ asset('storage/' . $pemasukan_dana->bukti_transaksi) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-file-pdf"></i> Lihat PDF
                                        </a>
                                    @endif
                                @else
                                    <span class="text-muted">Tidak ada bukti transaksi</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Dibuat Pada</th>
                            <td>{{ $pemasukan_dana->created_at->format('d-m-Y H:i:s') }}</td>
                        </tr>
                    </table>

                    <a href="{{ route('pemasukan_dana.index') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
