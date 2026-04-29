@extends('layouts.app')

@section('title', 'Detail Pengajuan Dana Keluar')

@section('content')
<style>
    .page-header {
        background: linear-gradient(135deg, #A0522D 0%, #D2691E 100%);
        border-radius: 16px;
        padding: 2rem;
        margin-bottom: 2rem;
        color: white;
        box-shadow: 0 10px 30px rgba(160, 82, 45, 0.3);
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
        color: #A0522D;
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
        color: #A0522D;
        font-size: 1.1rem;
    }

    .info-value {
        flex: 1;
        color: #6D4C41;
        font-size: 14px;
        font-weight: 500;
    }

    .badge-status {
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

    .badge-pending {
        background: linear-gradient(135deg, #ffc107 0%, #ffb300 100%);
        color: #000;
    }

    .badge-approved {
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        color: white;
    }

    .badge-rejected {
        background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
        color: white;
    }

    .nominal-highlight {
        font-size: 1.5rem;
        font-weight: 700;
        color: #A0522D;
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

    .action-section {
        background: #FFF8F0;
        padding: 1.5rem;
        border-top: 2px solid #E0D5C7;
        margin-top: 2rem;
    }

    .berkas-link {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.5rem 1rem;
        background: linear-gradient(135deg, #A0522D 0%, #D2691E 100%);
        color: white;
        text-decoration: none;
        border-radius: 8px;
        font-weight: 600;
        font-size: 13px;
        transition: all 0.3s ease;
    }

    .berkas-link:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(160, 82, 45, 0.4);
        color: white;
    }

    .keterangan-box {
        background: #F8F9FA;
        padding: 1rem;
        border-radius: 8px;
        border-left: 4px solid #A0522D;
        font-style: italic;
        color: #6D4C41;
    }
</style>

<div class="page-header">
    <div class="d-flex align-items-center">
        <i class="bi bi-file-earmark-text-fill me-3" style="font-size: 2rem;"></i>
        <div>
            <h2 class="mb-1 fw-bold">Detail Pengajuan Dana Keluar</h2>
            <p class="mb-0 opacity-75">Informasi lengkap pengajuan pengeluaran</p>
        </div>
    </div>
</div>

<div class="detail-card">
    <div class="detail-header">
        <h5>
            <i class="bi bi-info-circle-fill"></i>
            Informasi Pengajuan
        </h5>
    </div>

    <div class="detail-body">
        <div class="info-row">
            <div class="info-label">
                <i class="bi bi-calendar3"></i>
                Tanggal Pengajuan
            </div>
            <div class="info-value">
                {{ \Carbon\Carbon::parse($pengajuan->tanggal_pengajuan)->format('d F Y') }}
            </div>
        </div>

        <div class="info-row">
            <div class="info-label">
                <i class="bi bi-wallet2"></i>
                Jenis Pengeluaran
            </div>
            <div class="info-value">
                <strong>{{ $pengajuan->jenis_pengeluaran->nama_jenis_pengeluaran ?? '-' }}</strong>
            </div>
        </div>

        <div class="info-row">
            <div class="info-label">
                <i class="bi bi-cash-coin"></i>
                Nominal Pengajuan
            </div>
            <div class="info-value">
                <span class="nominal-highlight">
                    Rp {{ number_format($pengajuan->jumlah_pengajuan, 0, ',', '.') }}
                </span>
            </div>
        </div>

        <div class="info-row">
            <div class="info-label">
                <i class="bi bi-chat-left-text"></i>
                Keterangan
            </div>
            <div class="info-value">
                @if($pengajuan->keterangan)
                    <div class="keterangan-box">
                        {{ $pengajuan->keterangan }}
                    </div>
                @else
                    <span class="text-muted">-</span>
                @endif
            </div>
        </div>

        <div class="info-row">
            <div class="info-label">
                <i class="bi bi-flag"></i>
                Status Pengajuan
            </div>
            <div class="info-value">
                <span class="badge-status 
                    {{ $pengajuan->status == 'pending' ? 'badge-pending' : '' }}
                    {{ $pengajuan->status == 'approved' ? 'badge-approved' : '' }}
                    {{ $pengajuan->status == 'rejected' ? 'badge-rejected' : '' }}">
                    @if($pengajuan->status == 'pending')
                        <i class="bi bi-clock-history"></i>
                        Menunggu Persetujuan
                    @elseif($pengajuan->status == 'approved')
                        <i class="bi bi-check-circle"></i>
                        Disetujui
                    @else
                        <i class="bi bi-x-circle"></i>
                        Ditolak
                    @endif
                </span>
            </div>
        </div>

        @if($pengajuan->berkas_pengajuan)
        <div class="info-row">
            <div class="info-label">
                <i class="bi bi-paperclip"></i>
                Berkas Lampiran
            </div>
            <div class="info-value">
                <a href="{{ asset('storage/' . $pengajuan->berkas_pengajuan) }}" 
                   class="berkas-link" 
                   target="_blank">
                    <i class="bi bi-download"></i>
                    Unduh Berkas
                </a>
            </div>
        </div>
        @endif
    </div>

    <div class="action-section">
        <a href="{{ route('pengajuan_kas_keluar.index') }}" class="btn btn-back">
            <i class="bi bi-arrow-left me-2"></i>Kembali ke Daftar
        </a>
    </div>
</div>

@endsection