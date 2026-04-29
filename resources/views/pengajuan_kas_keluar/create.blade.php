@extends('layouts.app')

@section('title', 'Tambah Pengajuan Kas Keluar')

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
        max-width: 900px;
        margin: 0 auto;
    }

    .form-label {
        color: #5D4037;
        font-weight: 600;
        font-size: 14px;
        margin-bottom: 0.5rem;
    }

    .form-label .required {
        color: #D2691E;
        margin-left: 2px;
    }

    .form-control, .form-select {
        border: 2px solid #E0D5C7;
        border-radius: 10px;
        padding: 0.75rem 1rem;
        font-size: 14px;
        transition: all 0.3s ease;
        background: #FDFBF7;
    }

    .form-control:focus, .form-select:focus {
        outline: none;
        border-color: #8B4513;
        background: white;
        box-shadow: 0 0 0 4px rgba(139, 69, 19, 0.1);
    }

    .form-control::placeholder {
        color: #B0A394;
        font-style: italic;
    }

    .input-group-text {
        background: linear-gradient(135deg, #8B4513 0%, #D2691E 100%);
        color: white;
        border: none;
        border-radius: 10px 0 0 10px;
        font-weight: 600;
    }

    .input-group .form-control {
        border-radius: 0 10px 10px 0;
    }

    .btn-submit {
        background: linear-gradient(135deg, #8B4513 0%, #D2691E 100%);
        border: none;
        padding: 0.75rem 2rem;
        border-radius: 10px;
        color: white;
        font-weight: 600;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(139, 69, 19, 0.3);
    }

    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(139, 69, 19, 0.4);
        color: white;
    }

    .btn-cancel {
        background: #E0D5C7;
        border: none;
        padding: 0.75rem 2rem;
        border-radius: 10px;
        color: #5D4037;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-cancel:hover {
        background: #D0C5B7;
        transform: translateY(-2px);
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

    .invalid-feedback {
        font-size: 13px;
        margin-top: 0.5rem;
    }

    .form-section {
        margin-bottom: 2rem;
    }

    .section-title {
        color: #8B4513;
        font-size: 16px;
        font-weight: 700;
        margin-bottom: 1.5rem;
        padding-bottom: 0.5rem;
        border-bottom: 2px solid #E0D5C7;
    }

    .form-icon {
        color: #8B4513;
        margin-right: 0.5rem;
    }

    .btn-action-group {
        display: flex;
        gap: 1rem;
        justify-content: flex-end;
        margin-top: 2rem;
        padding-top: 2rem;
        border-top: 2px solid #F5F5F5;
    }

    .file-upload-wrapper {
        position: relative;
        overflow: hidden;
        display: inline-block;
        width: 100%;
    }

    .file-upload-input {
        position: absolute;
        font-size: 100px;
        opacity: 0;
        right: 0;
        top: 0;
        cursor: pointer;
    }

    .file-upload-label {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 1rem;
        border: 2px dashed #E0D5C7;
        border-radius: 10px;
        background: #FDFBF7;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .file-upload-label:hover {
        border-color: #8B4513;
        background: #FFF8F0;
    }

    .file-upload-label.has-file {
        border-color: #8B4513;
        background: #FFF8F0;
    }

    .file-info {
        display: none;
        margin-top: 0.5rem;
        padding: 0.5rem 1rem;
        background: #FFF8F0;
        border-radius: 8px;
        font-size: 13px;
        color: #5D4037;
    }

    .file-info.show {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .remove-file {
        color: #D2691E;
        cursor: pointer;
        font-weight: 600;
    }

    .remove-file:hover {
        color: #A0522D;
    }

    textarea.form-control {
        min-height: 120px;
        resize: vertical;
    }

    .nominal-preview {
        font-size: 18px;
        font-weight: 700;
        color: #8B4513;
        margin-top: 0.5rem;
        display: none;
    }

    .nominal-preview.show {
        display: block;
    }
</style>

<div class="page-header">
    <div class="d-flex align-items-center">
        <a href="{{ route('pengajuan_kas_keluar.index') }}" class="btn btn-light btn-sm me-3" style="border-radius: 10px;">
            <i class="bi bi-arrow-left"></i>
        </a>
        <div>
            <h2 class="mb-1 fw-bold">📤 Tambah Pengajuan Kas Keluar</h2>
            <p class="mb-0 opacity-75">Lengkapi form untuk mengajukan kas keluar</p>
        </div>
    </div>
</div>

{{-- ALERT ERROR --}}
@if($errors->any())
<div class="alert alert-danger alert-modern alert-dismissible fade show" role="alert">
    <i class="bi bi-exclamation-circle-fill me-2"></i>
    <strong>Terdapat kesalahan!</strong>
    <ul class="mb-0 mt-2">
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
</div>
@endif

<div class="form-card">
    <form action="{{ route('pengajuan_kas_keluar.store') }}" method="POST" enctype="multipart/form-data" id="kasKeluarForm">
        @csrf
        
        {{-- Informasi Pengajuan --}}
        <div class="form-section">
            <h5 class="section-title">
                <i class="bi bi-calendar-event form-icon"></i>
                Informasi Pengajuan
            </h5>

            {{-- Tanggal Pengajuan --}}
            <div class="mb-4">
                <label for="tanggal_pengajuan" class="form-label">
                    <i class="bi bi-calendar3 form-icon"></i>
                    Tanggal Pengajuan<span class="required">*</span>
                </label>
                <input type="date" 
                       class="form-control @error('tanggal_pengajuan') is-invalid @enderror" 
                       id="tanggal_pengajuan" 
                       name="tanggal_pengajuan" 
                       value="{{ old('tanggal_pengajuan', date('Y-m-d')) }}"
                       required>
                @error('tanggal_pengajuan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Jenis Pengeluaran --}}
            <div class="mb-4">
                <label for="jenis_pengeluaran_id" class="form-label">
                    <i class="bi bi-tags-fill form-icon"></i>
                    Jenis Pengeluaran<span class="required">*</span>
                </label>
                <select class="form-select @error('jenis_pengeluaran_id') is-invalid @enderror" 
                        id="jenis_pengeluaran_id" 
                        name="jenis_pengeluaran_id" 
                        required>
                    <option value="">-- Pilih Jenis Pengeluaran --</option>
                    @foreach($jenis_pengeluaran as $jp)
                        <option value="{{ $jp->id }}" {{ old('jenis_pengeluaran_id') == $jp->id ? 'selected' : '' }}>
                            {{ $jp->id_jenis_pengeluaran }} - {{ $jp->nama_jenis_pengeluaran }}
                        </option>
                    @endforeach
                </select>
                @error('jenis_pengeluaran_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        {{-- Detail Pengajuan --}}
        <div class="form-section">
            <h5 class="section-title">
                <i class="bi bi-cash-stack form-icon"></i>
                Detail Pengajuan
            </h5>

            {{-- Nominal Pengajuan --}}
            <div class="mb-4">
                <label for="jumlah_pengajuan" class="form-label">
                    <i class="bi bi-currency-dollar form-icon"></i>
                    Nominal Pengajuan<span class="required">*</span>
                </label>
                <div class="input-group">
                    <span class="input-group-text">Rp</span>
                    <input type="number" 
                           class="form-control @error('jumlah_pengajuan') is-invalid @enderror" 
                           id="jumlah_pengajuan" 
                           name="jumlah_pengajuan" 
                           value="{{ old('jumlah_pengajuan') }}"
                           placeholder="Masukkan nominal pengajuan..."
                           min="0"
                           step="1000"
                           required>
                    @error('jumlah_pengajuan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div id="nominalPreview" class="nominal-preview"></div>
                <small class="text-muted">
                    <i class="bi bi-info-circle me-1"></i>
                    Masukkan nominal dalam Rupiah
                </small>
            </div>

            {{-- Keterangan --}}
            <div class="mb-4">
                <label for="keterangan" class="form-label">
                    <i class="bi bi-file-text form-icon"></i>
                    Keterangan / Tujuan Penggunaan<span class="required">*</span>
                </label>
                <textarea class="form-control @error('keterangan') is-invalid @enderror" 
                          id="keterangan" 
                          name="keterangan" 
                          placeholder="Jelaskan tujuan penggunaan dana ini secara detail..."
                          required>{{ old('keterangan') }}</textarea>
                @error('keterangan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <small class="text-muted">
                    <i class="bi bi-info-circle me-1"></i>
                    Minimal 10 karakter
                </small>
            </div>
        </div>

        {{-- Berkas Pendukung --}}
        <div class="form-section">
            <h5 class="section-title">
                <i class="bi bi-paperclip form-icon"></i>
                Berkas Pendukung
            </h5>

            {{-- Upload File --}}
            <div class="mb-4">
                <label class="form-label">
                    <i class="bi bi-cloud-upload form-icon"></i>
                    Berkas Pengajuan
                    <small class="text-muted">(Opsional)</small>
                </label>
                <div class="file-upload-wrapper">
                    <label class="file-upload-label" id="fileLabel">
                        <div class="text-center">
                            <i class="bi bi-cloud-arrow-up" style="font-size: 2rem; color: #8B4513;"></i>
                            <p class="mb-0 mt-2" style="color: #5D4037;">
                                <strong>Klik untuk upload</strong> atau drag & drop
                            </p>
                            <small class="text-muted">PDF, DOC, DOCX, JPG, PNG (Max. 2MB)</small>
                        </div>
                    </label>
                    <input type="file" 
                           class="file-upload-input" 
                           id="berkas_pengajuan" 
                           name="berkas_pengajuan"
                           accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">
                </div>
                <div id="fileInfo" class="file-info">
                    <span>
                        <i class="bi bi-file-earmark-check me-2"></i>
                        <span id="fileName"></span>
                    </span>
                    <span class="remove-file" onclick="removeFile()">
                        <i class="bi bi-x-circle"></i> Hapus
                    </span>
                </div>
            </div>
        </div>

        {{-- Action Buttons --}}
        <div class="btn-action-group">
            <a href="{{ route('pengajuan_kas_keluar.index') }}" class="btn btn-cancel">
                <i class="bi bi-x-circle me-2"></i>Batal
            </a>
            <button type="submit" class="btn btn-submit">
                <i class="bi bi-send-fill me-2"></i>Ajukan Kas Keluar
            </button>
        </div>
    </form>
</div>

{{-- JAVASCRIPT --}}
<script>
// Format Rupiah
function formatRupiah(angka) {
    const numberString = angka.toString().replace(/[^,\d]/g, '');
    const split = numberString.split(',');
    const sisa = split[0].length % 3;
    let rupiah = split[0].substr(0, sisa);
    const ribuan = split[0].substr(sisa).match(/\d{3}/gi);
    
    if (ribuan) {
        const separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
    }
    
    rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
    return 'Rp ' + rupiah;
}

// Nominal Preview
document.getElementById('jumlah_pengajuan').addEventListener('input', function(e) {
    const value = this.value.replace(/[^\d]/g, '');
    this.value = value;
    
    const preview = document.getElementById('nominalPreview');
    if (value && parseInt(value) > 0) {
        preview.textContent = formatRupiah(value);
        preview.classList.add('show');
    } else {
        preview.classList.remove('show');
    }
});

// File Upload Handler
const fileInput = document.getElementById('berkas_pengajuan');
const fileLabel = document.getElementById('fileLabel');
const fileInfo = document.getElementById('fileInfo');
const fileName = document.getElementById('fileName');

fileInput.addEventListener('change', function(e) {
    if (this.files && this.files[0]) {
        const file = this.files[0];
        const maxSize = 2 * 1024 * 1024; // 2MB
        
        if (file.size > maxSize) {
            alert('Ukuran file maksimal 2MB!');
            this.value = '';
            return;
        }
        
        fileName.textContent = file.name;
        fileLabel.classList.add('has-file');
        fileInfo.classList.add('show');
    }
});

function removeFile() {
    fileInput.value = '';
    fileLabel.classList.remove('has-file');
    fileInfo.classList.remove('show');
}

// Form Validation
document.getElementById('kasKeluarForm').addEventListener('submit', function(e) {
    const tanggal = document.getElementById('tanggal_pengajuan').value;
    const jenis = document.getElementById('jenis_pengeluaran_id').value;
    const jumlah = document.getElementById('jumlah_pengajuan').value;
    const keterangan = document.getElementById('keterangan').value;

    if (!tanggal || !jenis || !jumlah || !keterangan) {
        e.preventDefault();
        alert('Mohon lengkapi semua field yang wajib diisi!');
        return false;
    }

    if (parseInt(jumlah) <= 0) {
        e.preventDefault();
        alert('Nominal pengajuan harus lebih dari 0!');
        return false;
    }

    if (keterangan.length < 10) {
        e.preventDefault();
        alert('Keterangan minimal 10 karakter!');
        return false;
    }
});

// Auto-hide alerts
document.addEventListener('DOMContentLoaded', function() {
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(function(alert) {
        setTimeout(function() {
            const bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        }, 5000);
    });
});
</script>

@endsection