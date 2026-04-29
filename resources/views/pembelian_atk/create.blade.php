@extends('layouts.app')

@section('title', 'Tambah Pembelian ATK')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            Tambah Pembelian ATK
        </div>
        <div class="card-body">

            {{-- Tampilkan Error Validasi --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Gagal menyimpan!</strong> Periksa kembali data berikut:
                    <ul class="mb-0 mt-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            <form action="{{ route('pembelian_atk.store') }}" method="POST" id="form-pembelian" enctype="multipart/form-data">                @csrf

                {{-- Tanggal --}}
                <div class="mb-3">
                    <label>Tanggal <span class="text-danger">*</span></label>
                    <input type="date" name="tanggal_pembelian" class="form-control" value="{{ old('tanggal_pembelian') }}" required>
                </div>

                {{-- Kode Transaksi --}}
                <div class="mb-3">
                    <label>Kode Transaksi <span class="text-danger">*</span></label>
                    <input type="text" name="kode_pembelian" class="form-control" placeholder="Kode transaksi..." value="{{ old('kode_pembelian') }}" required>
                </div>

                  {{-- Bukti Pembelian --}}
                <div class="mb-3">
                    <label>Bukti Pembelian</label>
                    <input type="file" name="bukti_pembelian" class="form-control">
                </div>

                <hr>

                <h5>Detail Pembelian ATK</h5>

                {{-- Header Detail --}}
                <div class="row fw-semibold mb-2 text-muted small">
                    <div class="col-md-3">Nama ATK</div>
                    <div class="col-md-2">Qty</div>
                    <div class="col-md-2">Satuan</div>
                    <div class="col-md-2">Harga</div>
                    <div class="col-md-2">Subtotal</div>
                    <div class="col-md-1"></div>
                </div>

                <div id="detail-container">

                    {{-- Baris Awal --}}
                    <div class="row mb-2 align-items-center detail-row">

                        <div class="col-md-3">
                            <select name="atk_id[]" class="form-control" required>
                                <option value="">Pilih ATK</option>
                                @foreach($atk as $a)
                                    <option value="{{ $a->id }}">{{ $a->kode_atk }} — {{ $a->nama_atk }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-2">
                            <input type="number" name="qty[]" class="form-control qty-input" min="1" placeholder="0" required>
                        </div>

                        <div class="col-md-2">
                            <select name="satuan[]" class="form-control">
                                <option value="pcs">Pcs</option>
                                <option value="box">Box</option>
                                <option value="pack">Pack</option>
                                <option value="rim">Rim</option>
                                <option value="lusin">Lusin</option>
                            </select>
                        </div>

                        <div class="col-md-2">
                            <input type="number" name="harga[]" class="form-control harga-input" min="0" placeholder="0" required>
                        </div>

                        <div class="col-md-2">
                            <span class="subtotal fw-semibold">Rp 0</span>
                        </div>

                        <div class="col-md-1">
                            <button type="button" class="btn btn-sm btn-outline-danger btn-hapus">×</button>
                        </div>

                    </div>

                </div>

                <button type="button" id="btn-tambah" class="btn btn-outline-secondary btn-sm mb-3">
                    + Tambah ATK
                </button>

                <div class="d-flex justify-content-end align-items-center border-top pt-3 mb-3">
                    <strong class="me-3">Total:</strong>
                    <span id="grand-total" class="fs-5 fw-semibold">Rp 0</span>
                </div>

                <button type="submit" class="btn btn-success">Simpan</button>
                <a href="{{ route('pembelian_atk.index') }}" class="btn btn-secondary">Kembali</a>

            </form>
        </div>
    </div>
</div>
@endsection



@push('scripts')
<script>

    const atkOptions = `
        @foreach($atk as $a)
            <option value="{{ $a->id }}">{{ $a->kode_atk }} — {{ $a->nama_atk }}</option>
        @endforeach
    `;

    function formatRp(n) {
        return 'Rp ' + Math.round(n).toLocaleString('id-ID');
    }

    function hitungSubtotal(row) {
        let qty   = parseFloat(row.querySelector('.qty-input').value)   || 0;
        let harga = parseFloat(row.querySelector('.harga-input').value) || 0;
        row.querySelector('.subtotal').textContent = formatRp(qty * harga);
        hitungTotal();
    }

    function hitungTotal() {
        let total = 0;
        document.querySelectorAll('.detail-row').forEach(row => {
            let qty   = parseFloat(row.querySelector('.qty-input').value)   || 0;
            let harga = parseFloat(row.querySelector('.harga-input').value) || 0;
            total += qty * harga;
        });
        document.getElementById('grand-total').textContent = formatRp(total);
    }

    function buatBaris() {
        let div = document.createElement('div');
        div.className = 'row mb-2 align-items-center detail-row';
        div.innerHTML = `
            <div class="col-md-3">
                <select name="atk_id[]" class="form-control" required>
                    <option value="">Pilih ATK</option>
                    ${atkOptions}
                </select>
            </div>
            <div class="col-md-2">
                <input type="number" name="qty[]" class="form-control qty-input" min="1" placeholder="0" required>
            </div>
            <div class="col-md-2">
                <select name="satuan[]" class="form-control">
                    <option value="pcs">Pcs</option>
                    <option value="box">Box</option>
                    <option value="pack">Pack</option>
                    <option value="rim">Rim</option>
                    <option value="lusin">Lusin</option>
                </select>
            </div>
            <div class="col-md-2">
                <input type="number" name="harga[]" class="form-control harga-input" min="0" placeholder="0" required>
            </div>
            <div class="col-md-2">
                <span class="subtotal fw-semibold">Rp 0</span>
            </div>
            <div class="col-md-1">
                <button type="button" class="btn btn-sm btn-outline-danger btn-hapus">×</button>
            </div>
        `;
        return div;
    }

    document.getElementById('btn-tambah').addEventListener('click', function () {
        document.getElementById('detail-container').appendChild(buatBaris());
    });

    document.getElementById('detail-container').addEventListener('input', function (e) {
        let row = e.target.closest('.detail-row');
        if (row) hitungSubtotal(row);
    });

    document.getElementById('detail-container').addEventListener('click', function (e) {
        if (e.target.classList.contains('btn-hapus')) {
            let rows = document.querySelectorAll('.detail-row');
            if (rows.length > 1) {
                e.target.closest('.detail-row').remove();
                hitungTotal();
            } else {
                alert('Minimal harus ada 1 baris ATK.');
            }
        }
    });

    document.getElementById('form-pembelian').addEventListener('submit', function (e) {
        let rows = document.querySelectorAll('.detail-row');
        if (rows.length === 0) {
            e.preventDefault();
            alert('Tambahkan minimal 1 ATK.');
        }
    });

</script>
@endpush