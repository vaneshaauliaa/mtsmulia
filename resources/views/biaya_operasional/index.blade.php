@extends ('layouts.app')

@section('title', 'Biaya Operasional')

@section('content')

<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Biaya Operasional</h1>
        <a href="{{ route('biaya_operasional.create') }}" class="btn btn-primary">Tambah Biaya Operasional</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-bordered table-hover">
                <thead class="thead-light">
                    <tr>
                        <th>No</th>
                        <th>Nama Biaya</th>
                        <th>Jumlah</th>
                        <th>Keterangan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($biaya_operasional as $index => $biaya)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $biaya->nama_biaya }}</td>
                            <td>{{ number_format($biaya->jumlah, 0, ',', '.') }}</td>
                            <td>{{ $biaya->keterangan }}</td>
                            <td>
                                <a href="{{ route('biaya_operasional.edit', $biaya->id) }}" class="btn btn-sm btn-warning">Edit</a>

                                <!-- Tombol Hapus -->
                                <form action="{{ route('biaya_operasional.destroy', $biaya->id) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus biaya operasional ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                </form>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Pagination -->
            {{ $biaya_operasional->links() }}
        </div>
    </div>
</div>


