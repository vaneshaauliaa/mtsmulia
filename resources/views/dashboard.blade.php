@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<style>
    .welcome-banner {
        background: linear-gradient(135deg, #8B4513 0%, #D2691E 100%);
        border-radius: 16px;
        padding: 2rem;
        margin-bottom: 2rem;
        color: white;
        box-shadow: 0 10px 30px rgba(139, 69, 19, 0.3);
        position: relative;
        overflow: hidden;
    }

    .welcome-banner::before {
        content: '';
        position: absolute;
        width: 300px;
        height: 300px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        top: -150px;
        right: -100px;
    }

    .welcome-content {
        position: relative;
        z-index: 1;
    }

    .welcome-title {
        font-size: 1.8rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
    }

    .welcome-subtitle {
        opacity: 0.9;
        font-size: 1rem;
    }

    .stat-card {
        background: white;
        border-radius: 16px;
        padding: 1.5rem;
        box-shadow: 0 5px 25px rgba(0,0,0,0.08);
        transition: all 0.3s ease;
        border: none;
        height: 100%;
        position: relative;
        overflow: hidden;
    }

    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 4px;
        background: linear-gradient(90deg, var(--card-color) 0%, var(--card-color-light) 100%);
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 30px rgba(0,0,0,0.12);
    }

    .stat-card.card-gaji {
        --card-color: #8B6914;
        --card-color-light: #CD853F;
    }

    .stat-card.card-masuk {
        --card-color: #28a745;
        --card-color-light: #20c997;
    }

    .stat-card.card-keluar {
        --card-color: #dc3545;
        --card-color-light: #ff6b6b;
    }

    .stat-icon {
        width: 60px;
        height: 60px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.8rem;
        margin-bottom: 1rem;
    }

    .stat-card.card-gaji .stat-icon {
        background: linear-gradient(135deg, #8B6914 0%, #CD853F 100%);
        color: white;
    }

    .stat-card.card-masuk .stat-icon {
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        color: white;
    }

    .stat-card.card-keluar .stat-icon {
        background: linear-gradient(135deg, #dc3545 0%, #ff6b6b 100%);
        color: white;
    }

    .stat-label {
        font-size: 0.875rem;
        color: #9E9E9E;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 0.5rem;
    }

    .stat-value {
        font-size: 1.8rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
    }

    .stat-card.card-gaji .stat-value {
        color: #8B6914;
    }

    .stat-card.card-masuk .stat-value {
        color: #28a745;
    }

    .stat-card.card-keluar .stat-value {
        color: #dc3545;
    }

    .stat-change {
        font-size: 0.8rem;
        font-weight: 600;
    }

    .stat-change.positive {
        color: #28a745;
    }

    .stat-change.negative {
        color: #dc3545;
    }

    .chart-card {
        background: white;
        border-radius: 16px;
        padding: 2rem;
        box-shadow: 0 5px 25px rgba(0,0,0,0.08);
        margin-bottom: 2rem;
    }

    .chart-header {
        margin-bottom: 1.5rem;
        padding-bottom: 1rem;
        border-bottom: 2px solid #F5F5F5;
    }

    .chart-title {
        font-size: 1.2rem;
        font-weight: 700;
        color: #5D4037;
        margin-bottom: 0.25rem;
    }

    .chart-subtitle {
        font-size: 0.875rem;
        color: #9E9E9E;
    }

    .info-cards-row {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .info-card {
        background: linear-gradient(135deg, #FFF8F0 0%, #FFE4B5 100%);
        border-radius: 12px;
        padding: 1.5rem;
        border-left: 4px solid #8B4513;
    }

    .info-card-title {
        font-size: 0.875rem;
        font-weight: 600;
        color: #8B4513;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .info-card-value {
        font-size: 1.5rem;
        font-weight: 700;
        color: #5D4037;
    }

    .quick-actions {
        background: white;
        border-radius: 16px;
        padding: 1.5rem;
        box-shadow: 0 5px 25px rgba(0,0,0,0.08);
        margin-bottom: 2rem;
    }

    .quick-actions-title {
        font-size: 1.1rem;
        font-weight: 700;
        color: #5D4037;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .action-btn {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.875rem 1.25rem;
        background: linear-gradient(135deg, #FFF8F0 0%, #FFE4B5 100%);
        border: 2px solid #E0D5C7;
        border-radius: 10px;
        color: #8B4513;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .action-btn:hover {
        background: linear-gradient(135deg, #8B4513 0%, #D2691E 100%);
        color: white;
        border-color: transparent;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(139, 69, 19, 0.3);
    }

    .action-icon {
        width: 40px;
        height: 40px;
        background: white;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
    }
</style>

{{-- WELCOME BANNER --}}
<div class="welcome-banner">
    <div class="welcome-content">
        <div class="welcome-title">👋 Selamat Datang, Admin!</div>
        <div class="welcome-subtitle">
            {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }} • 
            Sistem Informasi Keuangan MTs Mulia Insani
        </div>
    </div>
</div>

{{-- STATISTIK CARDS --}}
<div class="row g-4 mb-4">
    <div class="col-md-4">
        <div class="stat-card card-gaji">
            <div class="stat-icon">
                <i class="bi bi-people-fill"></i>
            </div>
            <div class="stat-label">Total Gaji Guru</div>
            <div class="stat-value">
                Rp {{ number_format($totalGajiGuru, 0, ',', '.') }}
            </div>
            <div class="stat-change">
                <i class="bi bi-graph-up me-1"></i>
                Bulan ini
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="stat-card card-masuk">
            <div class="stat-icon">
                <i class="bi bi-arrow-down-circle-fill"></i>
            </div>
            <div class="stat-label">Total Dana Masuk</div>
            <div class="stat-value">
                Rp {{ number_format($totalKasMasuk, 0, ',', '.') }}
            </div>
            <div class="stat-change positive">
                <i class="bi bi-arrow-up me-1"></i>
                Pemasukan
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="stat-card card-keluar">
            <div class="stat-icon">
                <i class="bi bi-arrow-up-circle-fill"></i>
            </div>
            <div class="stat-label">Total Dana Keluar</div>
            <div class="stat-value">
                Rp {{ number_format($totalKasKeluar, 0, ',', '.') }}
            </div>
            <div class="stat-change negative">
                <i class="bi bi-arrow-down me-1"></i>
                Pengeluaran
            </div>
        </div>
    </div>
</div>

{{-- INFO CARDS --}}
<div class="info-cards-row">
    <div class="info-card">
        <div class="info-card-title">
            <i class="bi bi-wallet2"></i>
            Saldo Akhir
        </div>
        <div class="info-card-value">
            Rp {{ number_format($totalKasMasuk - $totalKasKeluar, 0, ',', '.') }}
        </div>
    </div>

    <div class="info-card" style="background: linear-gradient(135deg, #E8F5E9 0%, #C8E6C9 100%); border-left-color: #28a745;">
        <div class="info-card-title" style="color: #28a745;">
            <i class="bi bi-graph-up-arrow"></i>
            Persentase Dana Masuk
        </div>
        <div class="info-card-value" style="color: #1b5e20;">
            @if($totalKasMasuk + $totalKasKeluar > 0)
                {{ number_format(($totalKasMasuk / ($totalKasMasuk + $totalKasKeluar)) * 100, 1) }}%
            @else
                0%
            @endif
        </div>
    </div>

    <div class="info-card" style="background: linear-gradient(135deg, #FFEBEE 0%, #FFCDD2 100%); border-left-color: #dc3545;">
        <div class="info-card-title" style="color: #dc3545;">
            <i class="bi bi-graph-down-arrow"></i>
            Persentase Dana Keluar
        </div>
        <div class="info-card-value" style="color: #b71c1c;">
            @if($totalKasMasuk + $totalKasKeluar > 0)
                {{ number_format(($totalKasKeluar / ($totalKasMasuk + $totalKasKeluar)) * 100, 1) }}%
            @else
                0%
            @endif
        </div>
    </div>
</div>

{{-- QUICK ACTIONS --}}
<div class="quick-actions">
    <div class="quick-actions-title">
        <i class="bi bi-lightning-fill"></i>
        Aksi Cepat
    </div>
    <div class="row g-3">
        <div class="col-md-3">
            <a href="{{ route('pencatatan_kas.create') }}" class="action-btn w-100">
                <div class="action-icon">
                    <i class="bi bi-plus-circle-fill"></i>
                </div>
                <span>Catat Dana</span>
            </a>
        </div>
        <div class="col-md-3">
            <a href="{{ route('pengajuan_kas_keluar.create') }}" class="action-btn w-100">
                <div class="action-icon">
                    <i class="bi bi-send-fill"></i>
                </div>
                <span>Ajukan Dana</span>
            </a>
        </div>
        <div class="col-md-3">
            <a href="{{ route('laporan.kas_masuk') }}" class="action-btn w-100">
                <div class="action-icon">
                    <i class="bi bi-file-earmark-text-fill"></i>
                </div>
                <span>Laporan</span>
            </a>
        </div>
        <div class="col-md-3">
            <a href="{{ route('guru.index') }}" class="action-btn w-100">
                <div class="action-icon">
                    <i class="bi bi-people-fill"></i>
                </div>
                <span>Data Guru</span>
            </a>
        </div>
    </div>
</div>

{{-- CHART --}}
<div class="chart-card">
    <div class="chart-header">
        <div class="chart-title">
            <i class="bi bi-bar-chart-fill me-2" style="color: #8B4513;"></i>
            Grafik Dana Masuk & Dana Keluar
        </div>
        <div class="chart-subtitle">Perbandingan total pemasukan dan pengeluaran</div>
    </div>
    <canvas id="kasChart" height="80"></canvas>
</div>

{{-- CHART JS --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('kasChart').getContext('2d');

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Dana Masuk', 'Dana Keluar'],
            datasets: [{
                label: 'Total (Rp)',
                data: [
                    {{ $totalKasMasuk }},
                    {{ $totalKasKeluar }}
                ],
                backgroundColor: [
                    'rgba(40, 167, 69, 0.8)',
                    'rgba(220, 53, 69, 0.8)'
                ],
                borderColor: [
                    'rgba(40, 167, 69, 1)',
                    'rgba(220, 53, 69, 1)'
                ],
                borderWidth: 2,
                borderRadius: 8,
                barThickness: 80
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: { 
                    display: false 
                },
                tooltip: {
                    backgroundColor: 'rgba(0, 0, 0, 0.8)',
                    padding: 12,
                    titleFont: {
                        size: 14,
                        weight: 'bold'
                    },
                    bodyFont: {
                        size: 13
                    },
                    callbacks: {
                        label: function(context) {
                            return 'Rp ' + context.parsed.y.toLocaleString('id-ID');
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(0, 0, 0, 0.05)',
                        drawBorder: false
                    },
                    ticks: {
                        callback: function(value) {
                            return 'Rp ' + (value / 1000000).toFixed(1) + 'jt';
                        },
                        font: {
                            size: 12
                        }
                    }
                },
                x: {
                    grid: {
                        display: false,
                        drawBorder: false
                    },
                    ticks: {
                        font: {
                            size: 13,
                            weight: 'bold'
                        }
                    }
                }
            }
        }
    });
</script>
@endsection