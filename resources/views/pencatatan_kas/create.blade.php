@extends('layouts.app')

@section('title', 'Tambah Pencatatan Dana')

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
    
    .form-container {
        background: white;
        border-radius: 16px;
        padding: 2rem;
        box-shadow: 0 5px 25px rgba(0,0,0,0.08);
        max-width: 700px;
    }
    
    .alert-danger {
        background: linear-gradient(135deg, #A0522D 0%, #D2691E 100%);
        border: none;
        border-radius: 12px;
        color: white;
        padding: 1rem 1.5rem;
        box-shadow: 0 4px 15px rgba(160, 82, 45, 0.2);
    }
    
    .alert-danger ul {
        margin-bottom: 0;
    }
    
    .alert-danger li {
        color: white;
    }
    
    .form-label {
        font-weight: 600;
        color: #5D4037;
        margin-bottom: 0.5rem;
        font-size: 14px;
    }
    
    .form-control, .form-select {
        border: 2px solid #E0E0E0;
        border-radius: 10px;
        padding: 0.75rem 1rem;
        transition: all 0.3s ease;
        font-size: 14px;
    }
    
    .form-control:focus, .form-select:focus {
        border-color: #8B4513;
        box-shadow: 0 0 0 0.2rem rgba(139, 69, 19, 0.15);
    }
    
    .form-control::placeholder {
        color: #BDBDBD;
    }
    
    .btn-save {
        background: linear-gradient(135deg, #8B4513 0%, #D2691E 100%);
        border: none;
        padding: 0.75rem 2rem;
        border-radius: 10px;
        color: white;
        font-weight: 600;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(139, 69, 19, 0.3);
    }
    
    .btn-save:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(139, 69, 19, 0.4);
        color: white;
    }
    
    .btn-back {
        background: #F5F5F5;
        border: 2px solid #E0E0E0;
        padding: 0.75rem 2rem;
        border-radius: 10px;
        color: #5D4037;
        font-weight: 600;
        transition: all 0.3s ease;
    }
    
    .btn-back:hover {
        background: #EEEEEE;
        border-color: #BDBDBD;
        color: #5D4037;
        transform: translateY(-2px);
    }
    
    .input-icon {
        position: relative;
    }
    
    .input-icon i {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: #8B4513;
    }
    
    .input-icon input,
    .input-icon select {
        padding-left: 45px;
    }
    
    .form-section {
        margin-bottom: 1.5rem;
        padding: 1.5rem;
        background: #FFF8F0;
        border-radius: 12px;
        border-left: 4px solid #8B4513;
    }
    
    .section-title {
        font-weight: 700;
        color: #8B4513;
        margin-bottom: 1rem;
        font-size: 16px;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .fade-in {
        animation: fadeIn 0.3s ease-in;
    }
    
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .file-upload-wrapper {
        position: relative;
        overflow: hidden;
        display: inline-block;
        width: 100%;
    }
    
    .file-upload-wrapper input[type=file] {
        position: absolute;
        left: -9999px;
    }
    
    .file-upload-label {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        padding: 1rem;
        background: #FFF8F0;
        border: 2px dashed #8B4513;
        border-radius: 10px;
        cursor: pointer;
        transition: all 0.3s ease;
        color: #8B4513;
        font-weight: 600;
    }
    
    .file-upload-label:hover {
        background: #FFEFD5;
        border-color: #D2691E;
    }
    
    .required-mark {
        color: #D2691E;
        font-weight: 700;
    }
</style>

<div class="page-header">
    <div class="d-flex align-items-center">
        <i class="bi bi-plus-circle-fill me-3" style="font-size: 2rem;"></i>
        <div>
            <h2 class="mb-1 fw-bold">Tambah Pencatatan Dana</h2>
            <p class="mb-0 opacity-75">Catat transaksi dana masuk atau keluar</p>
        </div>
    </div>
</div>

<div class="form-container">
    {{-- ERROR --}}
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>
            <strong>Terjadi Kesalahan!</strong>
            <ul class="mt-2 mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <form action="{{ route('pencatatan_kas.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-section">
            <div class="section-title">
                <i class="bi bi-info-circle-fill"></i>
                Informasi Transaksi
            </div>

            {{-- Tanggal --}}
            <div class="mb-3">
                <label class="form-label">
                    <i class="bi bi-calendar3 me-1"></i>
                    Tanggal <span class="required-mark">*</span>
                </label>
                <div class="input-icon">
                    <i class="bi bi-calendar-event"></i>
                    <input type="date" name="tanggal" class="form-control"
                           value="{{ old('tanggal', date('Y-m-d')) }}" required>
                </div>
            </div>

            {{-- Jenis Transaksi --}}
            <div class="mb-3">
                <label class="form-label">
                    <i class="bi bi-arrow-left-right me-1"></i>
                    Jenis Transaksi <span class="required-mark">*</span>
                </label>
                <div class="input-icon">
                    <i class="bi bi-grid-3x3-gap"></i>
                    <select name="jenis_transaksi" id="jenis_transaksi" class="form-select" required>
                        <option value="">-- Pilih Jenis Transaksi --</option>
                        <option value="kas_masuk">💰 Dana Masuk</option>
                        <option value="kas_keluar">💸 Dana Keluar</option>
                    </select>
                </div>
            </div>
        </div>

        {{-- Sumber Dana --}}
        <div class="mb-3 d-none fade-in" id="form-sumber-dana">
            <div class="form-section" style="background: #F0FFF0; border-left-color: #8B6914;">
                <label class="form-label">
                    <i class="bi bi-arrow-down-circle me-1" style="color: #8B6914;"></i>
                    Penerimaan Dana <span class="required-mark">*</span>
                </label>
                <div class="input-icon">
                    <i class="bi bi-cash-stack" style="color: #8B6914;"></i>
                    <select name="sumber_dana_id" class="form-select">
                        <option value="">-- Pilih Jenis Penerimaan Dana --</option>
                        @foreach($sumber_dana as $sd)
                            <option value="{{ $sd->id }}">{{ $sd->nama_sumber_dana }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        {{-- Jenis Pengeluaran --}}
        <div class="mb-3 d-none fade-in" id="form-jenis-pengeluaran">
            <div class="form-section" style="background: #FFF0F0; border-left-color: #A0522D;">
                <label class="form-label">
                    <i class="bi bi-arrow-up-circle me-1" style="color: #A0522D;"></i>
                    Jenis Pengeluaran Dana <span class="required-mark">*</span>
                </label>
                <div class="input-icon">
                    <i class="bi bi-wallet2" style="color: #A0522D;"></i>
                    <select name="jenis_pengeluaran_id" class="form-select">
                        <option value="">-- Pilih Jenis Pengeluaran Dana --</option>
                        @foreach($jenis_pengeluaran as $jp)
                            <option value="{{ $jp->id }}">{{ $jp->nama_jenis_pengeluaran }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="form-section">
            <div class="section-title">
                <i class="bi bi-cash-coin"></i>
                Detail Transaksi
            </div>

            {{-- Jumlah --}}
            <div class="mb-3">
                <label class="form-label">
                    <i class="bi bi-currency-dollar me-1"></i>
                    Nominal <span class="required-mark">*</span>
                </label>
                <div class="input-icon">
                    <i class="bi bi-calculator"></i>
                    <input type="number" name="jumlah" class="form-control" 
                           placeholder="Masukkan nominal transaksi" required>
                </div>
            </div>

            {{-- Keterangan --}}
            <div class="mb-3">
                <label class="form-label">
                    <i class="bi bi-sticky me-1"></i>
                    Keterangan
                </label>
                <textarea name="keterangan" class="form-control" rows="3" 
                          placeholder="Tambahkan catatan atau keterangan transaksi..."></textarea>
            </div>
        </div>

        {{-- Bukti --}}
        <div class="form-section">
            <div class="section-title">
                <i class="bi bi-paperclip"></i>
                Lampiran
            </div>
            
            <div class="mb-3">
                <label class="form-label">
                    <i class="bi bi-file-earmark-image me-1"></i>
                    Bukti Transaksi
                </label>
                <div class="file-upload-wrapper">
                    <input type="file" name="bukti_transaksi" id="bukti_transaksi" class="form-control">
                    <label for="bukti_transaksi" class="file-upload-label">
                        <i class="bi bi-cloud-upload"></i>
                        <span>Klik untuk upload bukti transaksi</span>
                    </label>
                </div>
                <small class="text-muted d-block mt-2">
                    <i class="bi bi-info-circle me-1"></i>
                    Format: JPG, PNG, PDF (Max. 2MB)
                </small>
            </div>
        </div>

        <div class="d-flex gap-2 mt-4">
            <button type="submit" class="btn btn-save">
                <i class="bi bi-save me-2"></i>Simpan Transaksi
            </button>
            <a href="{{ route('pencatatan_kas.index') }}" class="btn btn-back">
                <i class="bi bi-arrow-left me-2"></i>Kembali
            </a>
        </div>
    </form>
</div>

<script>
document.getElementById('jenis_transaksi').addEventListener('change', function () {
    const sumberDana = document.getElementById('form-sumber-dana');
    const jenisPengeluaran = document.getElementById('form-jenis-pengeluaran');

    sumberDana.classList.add('d-none');
    jenisPengeluaran.classList.add('d-none');

    if (this.value === 'kas_masuk') {
        sumberDana.classList.remove('d-none');
        sumberDana.querySelector('select').required = true;
        jenisPengeluaran.querySelector('select').required = false;
    } 
    if (this.value === 'kas_keluar') {
        jenisPengeluaran.classList.remove('d-none');
        jenisPengeluaran.querySelector('select').required = true;
        sumberDana.querySelector('select').required = false;
    }
});

// File upload preview
document.getElementById('bukti_transaksi').addEventListener('change', function(e) {
    const fileName = e.target.files[0]?.name;
    const label = document.querySelector('.file-upload-label span');
    
    if (fileName) {
        label.innerHTML = `<i class="bi bi-check-circle me-2"></i>${fileName}`;
        label.parentElement.style.background = '#E8F5E9';
        label.parentElement.style.borderColor = '#8B6914';
    } else {
        label.innerHTML = 'Klik untuk upload bukti transaksi';
        label.parentElement.style.background = '#FFF8F0';
        label.parentElement.style.borderColor = '#8B4513';
    }
});
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection