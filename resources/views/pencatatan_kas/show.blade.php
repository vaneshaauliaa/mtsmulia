@extends('layouts.app')

@section('title', 'Detail Pencatatan Dana')

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

    .detail-card {
        background: white;
        border-radius: 16px;
        box-shadow: 0 5px 25px rgba(0,0,0,0.08);
        overflow: hidden;
        max-width: 800px;
    }

    .detail-header {
        background: linear-gradient(135deg, #FFF8F0 0%, #FFE4B5 100%);
        padding: 1.5rem;
        border-bottom: 3px solid #E0D5C7;
    }

    .detail-header h5 {
        margin: 0;
        color: #8B4513;
        font-weight: 700;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .detail-body {
        padding: 2rem;
    }

    .info-row {
        display: flex;
        padding: 1.25rem;
        border-bottom: 1px solid #F5F5F5;
        transition: all 0.3s ease;
    }

    .info-row:hover {
        background: #FFF8F0;
    }

    .info-row:last-child {
        border-bottom: none;
    }

    .info-label {
        width: 35%;
        font-weight: 600;
        color: #5D4037;
        font-size: 14px;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .info-label i {
        color: #8B4513;
        font-size: 1.1rem;
    }

    .info-value {
        flex: 1;
        color: #6D4C41;
        font-size: 14px;
        font-weight: 500;
    }

    .badge-jenis {
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-weight: 600;
        font-size: 13px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .badge-masuk {
        background: linear-gradient(135deg, #8B6914 0%, #CD853F 100%);
        color: white;
    }

    .badge-keluar {
        background: linear-gradient(135deg, #A0522D 0%, #D2691E 100%);
        color: white;
    }

    .nominal-highlight {
        font-size: 1.5rem;
        font-weight: 700;
        color: #8B4513;
    }

    .keterangan-box {
        background: #F8F9FA;
        padding: 1rem;
        border-radius: 8px;
        border-left: 4px solid #8B4513;
        font-style: italic;
        color: #6D4C41;
        white-space: pre-wrap;
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

    .btn-bukti {
        background: linear-gradient(135deg, #17a2b8 0%, #20c997 100%);
        border: none;
        padding: 0.75rem 1.5rem;
        border-radius: 10px;
        color: white;
        font-weight: 600;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-bukti:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(23, 162, 184, 0.4);
        color: white;
    }

    .action-section {
        background: #FFF8F0;
        padding: 1.5rem;
        border-top: 2px solid #E0D5C7;
        margin-top: 2rem;
    }

    .no-attachment {
        text-align: center;
        padding: 2rem;
        color: #9E9E9E;
    }

    .no-attachment i {
        font-size: 2.5rem;
        margin-bottom: 0.5rem;
        opacity: 0.5;
    }

    .section-box {
        background: #FFF8F0;
        border-radius: 12px;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
        border-left: 4px solid #8B4513;
    }

    .section-box.masuk {
        background: linear-gradient(135deg, #F0FFF0 0%, #E8F5E9 100%);
        border-left-color: #8B6914;
    }

    .section-box.keluar {
        background: linear-gradient(135deg, #FFF0F0 0%, #FFEBEE 100%);
        border-left-color: #A0522D;
    }

    .section-box-title {
        font-weight: 700;
        color: #8B4513;
        margin-bottom: 1rem;
        font-size: 16px;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .section-box.masuk .section-box-title {
        color: #8B6914;
    }

    .section-box.keluar .section-box-title {
        color: #A0522D;
    }

    .divider {
        border-bottom: 2px solid #FFF8F0;
        margin: 1.5rem 0;
    }
</style>

<div class="page-header">
    <div class="d-flex align-items-center">
        <i class="bi bi-eye-fill me-3" style="font-size: 2rem;"></i>
        <div>
            <h2 class="mb-1 fw-bold">Detail Pencatatan Dana</h2>
            <p class="mb-0 opacity-75">Informasi lengkap transaksi yang telah dicatat</p>
        </div>
    </div>
</div>

<div class="detail-card">
    <div class="detail-header">
        <h5>
            <i class="bi bi-info-circle-fill"></i>
            Informasi Transaksi
        </h5>
    </div>

    <div class="detail-body">
        <div class="info-row">
            <div class="info-label">
                <i class="bi bi-calendar3"></i>
                Tanggal Transaksi
            </div>
            <div class="info-value">
                <strong>{{ \Carbon\Carbon::parse($pencatatan->tanggal)->format('d F Y') }}</strong>
            </div>
        </div>

        <div class="info-row">
            <div class="info-label">
                <i class="bi bi-arrow-left-right"></i>
                Jenis Transaksi
            </div>
            <div class="info-value">
                @if($pencatatan->jenis_transaksi == 'kas_masuk')
                    <span class="badge-jenis badge-masuk">
                        <i class="bi bi-arrow-down-circle-fill"></i>
                        Dana Masuk
                    </span>
                @else
                    <span class="badge-jenis badge-keluar">
                        <i class="bi bi-arrow-up-circle-fill"></i>
                        Dana Keluar
                    </span>
                @endif
            </div>
        </div>

        <div class="divider"></div>

        {{-- Jika Kas Masuk --}}
        @if($pencatatan->jenis_transaksi == 'kas_masuk')
        <div class="section-box masuk">
            <div class="section-box-title">
                <i class="bi bi-cash-stack"></i>
                Penerimaan Dana
            </div>
            <div style="font-size: 16px; font-weight: 600; color: #5D4037;">
                {{ $pencatatan->sumberDana->nama_sumber_dana ?? '-' }}
            </div>
        </div>
        @endif

        {{-- Jika Kas Keluar --}}
        @if($pencatatan->jenis_transaksi == 'kas_keluar')
        <div class="section-box keluar">
            <div class="section-box-title">
                <i class="bi bi-wallet2"></i>
                Jenis Pengeluaran Dana
            </div>
            <div style="font-size: 16px; font-weight: 600; color: #5D4037;">
                {{ $pencatatan->jenisPengeluaran->nama_jenis_pengeluaran ?? '-' }}
            </div>
        </div>
        @endif

        <div class="info-row">
            <div class="info-label">
                <i class="bi bi-cash-coin"></i>
                Nominal Transaksi
            </div>
            <div class="info-value">
                <span class="nominal-highlight">
                    Rp {{ number_format($pencatatan->jumlah, 0, ',', '.') }}
                </span>
            </div>
        </div>

        <div class="info-row">
            <div class="info-label">
                <i class="bi bi-chat-left-text"></i>
                Keterangan
            </div>
            <div class="info-value">
                @if($pencatatan->keterangan)
                    <div class="keterangan-box">
                        {{ $pencatatan->keterangan }}
                    </div>
                @else
                    <span class="text-muted">-</span>
                @endif
            </div>
        </div>

        <div class="divider"></div>

        <div class="info-row">
            <div class="info-label">
                <i class="bi bi-paperclip"></i>
                Bukti Transaksi
            </div>
            <div class="info-value">
                @if($pencatatan->bukti_transaksi)
                    <a href="{{ asset('storage/' . $pencatatan->bukti_transaksi) }}" 
                       class="btn-bukti" 
                       target="_blank">
                        <i class="bi bi-file-earmark-text"></i>
                        Lihat Bukti Transaksi
                    </a>
                @else
                    <div class="no-attachment">
                        <i class="bi bi-file-earmark-x"></i>
                        <p class="mb-0">Tidak ada lampiran</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="action-section">
        <a href="{{ route('pencatatan_kas.index') }}" class="btn btn-back">
            <i class="bi bi-arrow-left me-2"></i>Kembali ke Daftar
        </a>
    </div>
</div>

@endsection