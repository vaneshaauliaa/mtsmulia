@extends('layouts.app')

@section('title', 'Detail Biaya Operasional')

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

    .btn-cancel {
        background: rgba(255,255,255,0.2);
        border: 2px solid rgba(255,255,255,0.5);
        padding: 0.6rem 1.5rem;
        border-radius: 8px;
        color: white;
        font-weight: 600;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
    }

    .btn-cancel:hover {
        background: rgba(255,255,255,0.35);
        color: white;
    }

    .detail-card {
        background: white;
        border-radius: 16px;
        box-shadow: 0 5px 25px rgba(0,0,0,0.08);
        overflow: hidden;
        margin-bottom: 2rem;
    }

    .detail-section-title {
        font-weight: 700;
        color: #8B4513;
        font-size: 0.95rem;
        padding: 1.25rem 1.5rem 0.75rem;
        border-bottom: 2px solid #F5E6D3;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        background: #FFFAF5;
    }

    .detail-row {
        display: flex;
        border-bottom: 1px solid #F5EDE3;
        transition: background 0.2s ease;
    }

    .detail-row:last-child {
        border-bottom: none;
    }

    .detail-row:hover {
        background: #FFF8F0;
    }

    .detail-label {
        width: 220px;
        min-width: 220px;
        padding: 1rem 1.5rem;
        font-weight: 600;
        color: #8B4513;
        font-size: 13px;
        text-transform: uppercase;
        letter-spacing: 0.3px;
        background: #FFFAF5;
        border-right: 2px solid #F5E6D3;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .detail-value {
        flex: 1;
        padding: 1rem 1.5rem;
        color: #5D4037;
        font-size: 14px;
        font-weight: 500;
        display: flex;
        align-items: center;
    }

    .kode-badge {
        background: #FFF8F0;
        border: 1px solid #E0D5C7;
        color: #8B4513;
        font-family: monospace;
        font-weight: 700;
        font-size: 15px;
        padding: 0.35rem 0.9rem;
        border-radius: 6px;
        letter-spacing: 0.5px;
    }

    .date-badge {
        background: linear-gradient(135deg, #17a2b8 0%, #20c997 100%);
        color: white;
        padding: 0.4rem 1rem;
        border-radius: 8px;
        font-weight: 600;
        font-size: 13px;
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
    }

    .jenis-badge {
        background: linear-gradient(135deg, #FFF8F0 0%, #FFE4B5 100%);
        color: #8B4513;
        border: 1px solid #E0D5C7;
        padding: 0.4rem 1rem;
        border-radius: 8px;
        font-weight: 600;
        font-size: 13px;
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
    }

    .total-value {
        font-weight: 700;
        color: #8B6914;
        font-size: 20px;
    }

    .empty-value {
        color: #BCAAA4;
        font-style: italic;
        font-size: 13px;
    }

    .bukti-image {
        max-width: 380px;
        border-radius: 10px;
        border: 2px solid #E0D5C7;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        transition: transform 0.3s ease;
        cursor: zoom-in;
    }

    .bukti-image:hover {
        transform: scale(1.02);
    }

    .btn-pdf {
        background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
        color: white;
        padding: 0.5rem 1.25rem;
        border-radius: 8px;
        border: none;
        font-size: 13px;
        font-weight: 600;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
    }

    .btn-pdf:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(220, 53, 69, 0.4);
        color: white;
    }

    .action-bar {
        background: white;
        border-radius: 16px;
        padding: 1.25rem 1.5rem;
        box-shadow: 0 5px 25px rgba(0,0,0,0.08);
        display: flex;
        justify-content: flex-end;
        gap: 1rem;
    }

    .btn-back {
        background: #F5F5F5;
        border: 2px solid #E0E0E0;
        padding: 0.65rem 1.75rem;
        border-radius: 8px;
        color: #5D4037;
        font-weight: 600;
        font-size: 14px;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-back:hover {
        background: #EEEEEE;
        border-color: #BDBDBD;
        color: #5D4037;
    }

    /* Image modal */
    .img-modal {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(0,0,0,0.85);
        z-index: 9999;
        align-items: center;
        justify-content: center;
    }

    .img-modal.active {
        display: flex;
    }

    .img-modal img {
        max-width: 90vw;
        max-height: 90vh;
        border-radius: 12px;
        box-shadow: 0 20px 60px rgba(0,0,0,0.5);
    }

    .img-modal-close {
        position: absolute;
        top: 1.5rem;
        right: 1.5rem;
        color: white;
        font-size: 2rem;
        cursor: pointer;
        line-height: 1;
        opacity: 0.8;
        transition: opacity 0.2s;
    }

    .img-modal-close:hover {
        opacity: 1;
    }
</style>

{{-- PAGE HEADER --}}
<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h2 class="mb-1 fw-bold">🧾 Detail Biaya Operasional</h2>
            <p class="mb-0 opacity-75">Informasi lengkap transaksi biaya operasional</p>
        </div>
        <a href="{{ route('biaya_operasional.index') }}" class="btn-cancel">
            <i class="bi bi-arrow-left me-2"></i>Kembali
        </a>
    </div>
</div>

{{-- DETAIL CARD --}}
<div class="detail-card">

    {{-- SEKSI: INFORMASI TRANSAKSI --}}
    <div class="detail-section-title">
        <i class="bi bi-receipt"></i>
        Informasi Transaksi
    </div>

    <div class="detail-row">
        <div class="detail-label">
            <i class="bi bi-calendar3"></i> Tanggal
        </div>
        <div class="detail-value">
            <span class="date-badge">
                <i class="bi bi-calendar-event"></i>
                {{ \Carbon\Carbon::parse($biaya_operasional->tanggal)->format('d-m-Y') }}
            </span>
        </div>
    </div>

    <div class="detail-row">
        <div class="detail-label">
            <i class="bi bi-hash"></i> Kode Transaksi
        </div>
        <div class="detail-value">
            <span class="kode-badge">
                <i class="bi bi-upc-scan me-1"></i>
                {{ $biaya_operasional->kode_transaksi }}
            </span>
        </div>
    </div>

    <div class="detail-row">
        <div class="detail-label">
            <i class="bi bi-file-text"></i> Nomor Nota
        </div>
        <div class="detail-value">
            @if($biaya_operasional->nomor_nota)
                {{ $biaya_operasional->nomor_nota }}
            @else
                <span class="empty-value">Tidak ada nomor nota</span>
            @endif
        </div>
    </div>

    <div class="detail-row">
        <div class="detail-label">
            <i class="bi bi-tag"></i> Jenis Pengeluaran
        </div>
        <div class="detail-value">
            <span class="jenis-badge">
                <i class="bi bi-tag-fill"></i>
                {{ $biaya_operasional->jenis_pengeluaran->nama_jenis_pengeluaran ?? '-' }}
            </span>
        </div>
    </div>

    {{-- SEKSI: DETAIL BIAYA --}}
    <div class="detail-section-title">
        <i class="bi bi-cash-stack"></i>
        Detail Biaya
    </div>

    <div class="detail-row">
        <div class="detail-label">
            <i class="bi bi-currency-dollar"></i> Total
        </div>
        <div class="detail-value">
            <span class="total-value">
                Rp {{ number_format($biaya_operasional->total, 0, ',', '.') }}
            </span>
        </div>
    </div>

    <div class="detail-row">
        <div class="detail-label">
            <i class="bi bi-chat-left-text"></i> Keterangan
        </div>
        <div class="detail-value">
            @if($biaya_operasional->keterangan)
                {{ $biaya_operasional->keterangan }}
            @else
                <span class="empty-value">Tidak ada keterangan</span>
            @endif
        </div>
    </div>

    {{-- SEKSI: BUKTI TRANSAKSI --}}
    <div class="detail-section-title">
        <i class="bi bi-paperclip"></i>
        Bukti Transaksi
    </div>

    <div class="detail-row">
        <div class="detail-label">
            <i class="bi bi-image"></i> Lampiran
        </div>
        <div class="detail-value">
            @if($biaya_operasional->bukti_transaksi)
                @php
                    $extension = strtolower(pathinfo($biaya_operasional->bukti_transaksi, PATHINFO_EXTENSION));
                @endphp
                @if(in_array($extension, ['jpg', 'jpeg', 'png']))
                    <img src="{{ asset('storage/' . $biaya_operasional->bukti_transaksi) }}"
                         alt="Bukti Transaksi"
                         class="bukti-image"
                         onclick="openModal(this.src)">
                @elseif($extension === 'pdf')
                    <a href="{{ asset('storage/' . $biaya_operasional->bukti_transaksi) }}"
                       target="_blank" class="btn-pdf">
                        <i class="bi bi-file-earmark-pdf"></i> Lihat PDF
                    </a>
                @endif
            @else
                <span class="empty-value">
                    <i class="bi bi-slash-circle me-1"></i>
                    Tidak ada bukti transaksi
                </span>
            @endif
        </div>
    </div>

    {{-- SEKSI: METADATA --}}
    <div class="detail-section-title">
        <i class="bi bi-info-circle"></i>
        Informasi Sistem
    </div>

    <div class="detail-row">
        <div class="detail-label">
            <i class="bi bi-clock-history"></i> Dibuat Pada
        </div>
        <div class="detail-value">
            <i class="bi bi-clock me-1" style="color: #8B4513;"></i>
            {{ $biaya_operasional->created_at->format('d-m-Y H:i:s') }}
        </div>
    </div>

</div>

{{-- ACTION BAR --}}
<div class="action-bar">
    <a href="{{ route('biaya_operasional.index') }}" class="btn-back">
        <i class="bi bi-arrow-left"></i> Kembali ke Daftar
    </a>
</div>

{{-- IMAGE MODAL --}}
<div class="img-modal" id="imgModal" onclick="closeModal()">
    <span class="img-modal-close" onclick="closeModal()">&times;</span>
    <img id="modalImg" src="" alt="Bukti Transaksi">
</div>

<script>
function openModal(src) {
    document.getElementById('modalImg').src = src;
    document.getElementById('imgModal').classList.add('active');
    document.body.style.overflow = 'hidden';
}

function closeModal() {
    document.getElementById('imgModal').classList.remove('active');
    document.body.style.overflow = '';
}

document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') closeModal();
});
</script>

@endsection