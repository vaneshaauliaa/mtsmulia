@extends('layouts.app')

@section('title', 'Data Pembelian ATK')

@section('content')

<div class="page-header">
    <h1>Data Pembelian ATK</h1>
</div>
@if (session('success'))
    <div class="alert alert-success alert-modern">
        {{ session('success') }}
    </div>
@endif
@if (session('error'))
    <div class="alert alert-danger alert-modern">
        {{ session('error') }}
    </div>
@endif

<div class="mb-3">
    <a href="{{ route('pembelian_atk.create') }}" class="btn btn-add">Tambah Pembelian ATK</a>
</div>

<div class="table-container">
    <table class="table table-striped table-modern">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Pembelian</th>
                <th>Tanggal</th>
                <th>Total Harga</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($pembelian_atk as $index => $item)
            <tr>
                <td>{{ $pembelian_atk->firstItem() + $index }}</td>
                <td>{{ $item->kode_pembelian }}</td>
                <td>{{ $item->tanggal_pembelian->format('d/m/Y') }}</td>
                <td>Rp {{ number_format($item->total_harga, 0, ',', '.') }}</td>
                <td>
                    <a href="{{ route('pembelian_atk.show', $item->id) }}" class="btn btn-sm btn-primary">Detail</a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center">Belum ada data pembelian ATK.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    {{ $pembelian_atk->links() }}
</div>
@endsection