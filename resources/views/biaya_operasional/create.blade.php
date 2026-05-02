@extends('layouts.app')

@section('title', 'Tambah Biaya Operasional')

@section('content')
<style>
    .page-header {
        background: linear-gradient(135deg, #8B4513 0%, #D2691E 100%);
        border-radius: 16px;
        padding: 2rem;
        margin-bottom: 2rem;
        color: white;
        box-shadow: 0 10px 30px rgba(139, 69, 19, 0.3);
    }

    .form-card {
        background: white;
        border-radius: 16px;
        padding: 2rem;
        box-shadow: 0 5px 25px rgba(0,0,0,0.08);
        margin-bottom: 2rem;
    }

    .section-title {
        font-weight: 700;
        color: #8B4513;
        font-size: 1rem;
        margin-bottom: 1.25rem;
        padding-bottom: 0.75rem;
        border-bottom: 2px solid #F5E6D3;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .form-label {
        font-weight: 600;
        color: #5D4037;
        margin-bottom: 0.5rem;
        font-size: 13px;
    }

    .form-label .required {
        color: #D2691E;
        margin-left: 2px;
    }

    .form-control, .form-select {
        border: 2px solid #E0D5C7;
        border-radius: 8px;
        padding: 0.65rem 0.9rem;
        font-size: 14px;
        transition: all 0.3s ease;
        color: #5D4037;
    }

    .form-control:focus, .form-select:focus {
        border-color: #8B4513;
        box-shadow: 0 0 0 0.2rem rgba(139, 69, 19, 0.15);
        outline: none;
    }

    .form-control[readonly] {
        background: #FFF8F0;
        color: #8B4513;
        font-weight: 600;
        font-family: monospace;
        cursor: not-allowed;
    }

    .form-control::placeholder {
        color: #BCAAA4;
        font-weight: 400;
    }

    .input-group-text {
        background: linear-gradient(135deg, #8B4513 0%, #D2691E 100%);
        border: none;
        color: white;
        font-weight: 600;
        border-radius: 8px 0 0 8px;
        padding: 0.65rem 1rem;
    }

    .input-group .form-control {
        border-radius: 0 8px 8px 0;
    }

    .file-upload-area {
        border: 2px dashed #E0D5C7;
        border-radius: 8px;
        padding: 1.5rem;
        text-align: center;
        transition: all 0.3s ease;
        cursor: pointer;
        background: #FAFAFA;
    }

    .file-upload-area:hover {
        border-color: #8B4513;
        background: #FFF8F0;
    }

    .file-upload-area i {
        font-size: 2rem;
        color: #8B4513;
        opacity: 0.6;
        margin-bottom: 0.5rem;
        display: block;
    }

    .file-upload-area p {
        color: #9E9E9E;
        font-size: 13px;
        margin: 0;
    }

    .file-upload-area input[type="file"] {
        position: absolute;
        inset: 0;
        opacity: 0;
        cursor: pointer;
        width: 100%;
        height: 100%;
    }

    .optional-badge {
        background: #F5F5F5;
        color: #9E9E9E;
        font-size: 10px;
        font-weight: 600;
        padding: 0.15rem 0.5rem;
        border-radius: 20px;
        margin-left: 0.4rem;
        text-transform: uppercase;
        letter-spacing: 0.3px;
    }

    .btn-submit {
        background: linear-gradient(135deg, #8B4513 0%, #D2691E 100%);
        border: none;
        padding: 0.75rem 2rem;
        border-radius: 8px;
        color: white;
        font-weight: 600;
        font-size: 15px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(139, 69, 19, 0.3);
    }

    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(139, 69, 19, 0.4);
        color: white;
    }

    .btn-cancel {
        background: #F5F5F5;
        border: 2px solid #E0E0E0;
        padding: 0.75rem 2rem;
        border-radius: 8px;
        color: #5D4037;
        font-weight: 600;
        font-size: 15px;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-block;
    }

    .btn-cancel:hover {
        background: #EEEEEE;
        border-color: #BDBDBD;
        color: #5D4037;
    }

    .alert-modern {
        border: none;
        border-radius: 12px;
        padding: 1rem 1.5rem;
        margin-bottom: 1.5rem;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }

    .alert-danger {
        background: linear-gradient(135deg, #A0522D 0%, #D2691E 100%);
        color: white;
    }

    .kode-preview {
        background: #FFF8F0;
        border: 2px solid #E0D5C7;
        border-radius: 8px;
        padding: 0.65rem 0.9rem;
        font-family: monospace;
        font-weight: 700;
        color: #8B4513;
        font-size: 15px;
        letter-spacing: 0.5px;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
</style>

{{-- PAGE HEADER --}}
<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h2 class="mb-1 fw-bold">🧾 Tambah Biaya Operasional</h2>
            <p class="mb-0 opacity-75">Isi form berikut untuk mencatat biaya operasional baru</p>
        </div>
        <a href="{{ route('biaya_operasional.index') }}" class="btn-cancel">
            <i class="bi bi-arrow-left me-2"></i>Kembali
        </a>
    </div>
</div>

{{-- VALIDATION ERRORS --}}
@if($errors->any())
<div class="alert alert-danger alert-modern alert-dismissible fade show" role="alert">
    <i class="bi bi-exclamation-circle-fill me-2"></i>
    <strong>Terjadi kesalahan:</strong>
    <ul class="mb-0 mt-1">
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
</div>
@endif

{{-- FORM CARD --}}
<div class="form-card">
    <form method="POST" action="{{ route('biaya_operasional.store') }}" enctype="multipart/form-data">
        @csrf

        {{-- INFORMASI TRANSAKSI --}}
        <div class="section-title">
            <i class="bi bi-receipt"></i>
            Informasi Transaksi
        </div>

        <div class="row g-3 mb-4">
            {{-- Kode Transaksi --}}
            <div class="col-md-6">
                <label class="form-label">
                    <i class="bi bi-hash me-1"></i>
                    Kode Transaksi
                </label>
                <div class="kode-preview">
                    <i class="bi bi-upc-scan"></i>
                    {{ $kodeTransaksi }}
                </div>
                <input type="hidden" name="kode_transaksi" value="{{ $kodeTransaksi }}">
            </div>

            {{-- Tanggal --}}
            <div class="col-md-6">
                <label class="form-label" for="tanggal">
                    <i class="bi bi-calendar3 me-1"></i>
                    Tanggal <span class="required">*</span>
                </label>
                <input type="date" class="form-control @error('tanggal') is-invalid @enderror"
                       id="tanggal" name="tanggal"
                       value="{{ old('tanggal') }}" required>
                @error('tanggal')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Nomor Nota --}}
            <div class="col-md-6">
                <label class="form-label" for="nomor_nota">
                    <i class="bi bi-file-text me-1"></i>
                    Nomor Nota
                    <span class="optional-badge">Opsional</span>
                </label>
                <input type="text" class="form-control @error('nomor_nota') is-invalid @enderror"
                       id="nomor_nota" name="nomor_nota"
                       value="{{ old('nomor_nota') }}"
                       placeholder="Contoh: NOT-2024-001">
                @error('nomor_nota')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Jenis Pengeluaran --}}
            <div class="col-md-6">
                <label class="form-label" for="jenis_pengeluaran_id">
                    <i class="bi bi-tag me-1"></i>
                    Jenis Pengeluaran <span class="required">*</span>
                </label>
                <select class="form-select @error('jenis_pengeluaran_id') is-invalid @enderror"
                        id="jenis_pengeluaran_id" name="jenis_pengeluaran_id" required>
                    <option value="">-- Pilih Jenis Pengeluaran --</option>
                    @foreach($jenisPengeluaran as $jenis)
                        <option value="{{ $jenis->id }}" {{ old('jenis_pengeluaran_id') == $jenis->id ? 'selected' : '' }}>
                            {{ $jenis->nama_jenis_pengeluaran }}
                        </option>
                    @endforeach
                </select>
                @error('jenis_pengeluaran_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        {{-- DETAIL BIAYA --}}
        <div class="section-title">
            <i class="bi bi-cash-stack"></i>
            Detail Biaya
        </div>

        <div class="row g-3 mb-4">
            {{-- Total --}}
            <div class="col-md-6">
                <label class="form-label" for="total">
                    <i class="bi bi-currency-dollar me-1"></i>
                    Total <span class="required">*</span>
                </label>
                <div class="input-group">
                    <span class="input-group-text">Rp</span>
                    <input type="number" step="1" min="0"
                           class="form-control @error('total') is-invalid @enderror"
                           id="total" name="total"
                           value="{{ old('total') }}"
                           placeholder="0" required>
                    @error('total')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            {{-- Keterangan --}}
            <div class="col-md-6">
                <label class="form-label" for="keterangan">
                    <i class="bi bi-chat-left-text me-1"></i>
                    Keterangan
                    <span class="optional-badge">Opsional</span>
                </label>
                <textarea class="form-control @error('keterangan') is-invalid @enderror"
                          id="keterangan" name="keterangan"
                          rows="3"
                          placeholder="Tambahkan keterangan jika diperlukan...">{{ old('keterangan') }}</textarea>
                @error('keterangan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        {{-- BUKTI TRANSAKSI --}}
        <div class="section-title">
            <i class="bi bi-paperclip"></i>
            Bukti Transaksi
            <span class="optional-badge">Opsional</span>
        </div>

        <div class="row g-3 mb-4">
            <div class="col-12">
                <div class="file-upload-area position-relative">
                    <input type="file" id="bukti_transaksi" name="bukti_transaksi"
                           accept="image/*,.pdf" onchange="updateFileName(this)">
                    <i class="bi bi-cloud-arrow-up"></i>
                    <p id="file-label">Klik atau seret file ke sini untuk mengunggah</p>
                    <p style="color: #BCAAA4; font-size: 11px; margin-top: 0.25rem;">
                        Format: JPG, PNG, PDF — Maks. 2MB
                    </p>
                </div>
            </div>
        </div>

        {{-- TOMBOL AKSI --}}
        <div class="d-flex gap-3 justify-content-end pt-2 border-top" style="border-color: #F5E6D3 !important;">
            <a href="{{ route('biaya_operasional.index') }}" class="btn-cancel">
                <i class="bi bi-x-circle me-2"></i>Batal
            </a>
            <button type="submit" class="btn-submit">
                <i class="bi bi-save me-2"></i>Simpan Data
            </button>
        </div>

    </form>
</div>

<script>
function updateFileName(input) {
    const label = document.getElementById('file-label');
    if (input.files && input.files[0]) {
        label.textContent = '📎 ' + input.files[0].name;
        label.style.color = '#8B4513';
        label.style.fontWeight = '600';
    } else {
        label.textContent = 'Klik atau seret file ke sini untuk mengunggah';
        label.style.color = '#9E9E9E';
        label.style.fontWeight = '400';
    }
}
</script>

@endsection