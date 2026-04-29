@extends('layouts.app')

@section('title', 'Detail Data Guru')

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

    .card-modern {
        background: white;
        border-radius: 16px;
        box-shadow: 0 5px 25px rgba(0,0,0,0.08);
        border: none;
        overflow: hidden;
        transition: transform 0.3s ease;
    }

    .card-modern:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 30px rgba(139, 69, 19, 0.15);
    }
    
    .card-body {
        padding: 1.5rem;
    }

    .card-header-info {
        background: linear-gradient(135deg, #8B4513 0%, #D2691E 100%);
        color: white;
        padding: 1.25rem 1.5rem;
        border-bottom: none;
    }

    .card-header-mengajar {
        background: linear-gradient(135deg, #8B6914 0%, #CD853F 100%);
        color: white;
        padding: 1.25rem 1.5rem;
        border-bottom: none;
    }

    .card-header-ekskul {
        background: linear-gradient(135deg, #A0522D 0%, #D2691E 100%);
        color: white;
        padding: 1.25rem 1.5rem;
        border-bottom: none;
    }

    .card-header-modern h5 {
        margin: 0;
        font-weight: 700;
        font-size: 1.1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .info-group {
        margin-bottom: 1.5rem;
    }

    .info-label {
        font-size: 0.75rem;
        color: #9E9E9E;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 0.5rem;
        font-weight: 600;
    }

    .info-value {
        font-size: 1.1rem;
        font-weight: 600;
        color: #5D4037;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .info-value i {
        color: #8B4513;
        font-size: 1.2rem;
    }

    .gender-male {
        color: #2196F3;
    }

    .gender-female {
        color: #E91E63;
    }

    .badge-jabatan-detail {
        background: linear-gradient(135deg, #8B6914 0%, #CD853F 100%);
        color: white;
        padding: 0.6rem 1.2rem;
        border-radius: 10px;
        font-weight: 600;
        font-size: 0.9rem;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .badge-no-jabatan {
        background: #E0E0E0;
        color: #757575;
        padding: 0.6rem 1.2rem;
        border-radius: 10px;
        font-weight: 600;
        font-size: 0.9rem;
    }

    .table-custom {
        margin-bottom: 0;
    }

    .table-custom thead {
        background: #FFF8F0;
        border-bottom: 2px solid #E0D5C7;
    }

    .table-custom thead th {
        padding: 1rem 0.75rem;
        font-weight: 600;
        font-size: 0.85rem;
        color: #5D4037;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border: none;
    }

    .table-custom tbody tr {
        transition: all 0.3s ease;
        border-bottom: 1px solid #F5F5F5;
    }

    .table-custom tbody tr:hover {
        background: #FFF8F0;
        transform: scale(1.01);
    }

    .table-custom tbody td {
        padding: 1rem 0.75rem;
        vertical-align: middle;
        border: none;
        color: #5D4037;
    }

    .no-badge {
        background: linear-gradient(135deg, #8B4513 0%, #D2691E 100%);
        color: white;
        padding: 0.3rem 0.7rem;
        border-radius: 8px;
        font-weight: 700;
        font-size: 0.85rem;
    }

    .badge-mapel {
        background: #FFF8F0;
        color: #8B4513;
        padding: 0.5rem 1rem;
        border-radius: 8px;
        font-weight: 600;
        border: 2px solid #E0D5C7;
    }

    .badge-kelas {
        background: linear-gradient(135deg, #17a2b8 0%, #20c997 100%);
        color: white;
        padding: 0.5rem 1rem;
        border-radius: 8px;
        font-weight: 600;
    }

    .empty-state {
        padding: 3rem;
        text-align: center;
    }
    
    .empty-state i {
        font-size: 3.5rem;
        color: #D2691E;
        opacity: 0.5;
        margin-bottom: 1rem;
    }

    .empty-state p {
        color: #6D4C41;
        font-weight: 500;
        margin: 0;
    }

    .action-card {
        background: white;
        border-radius: 16px;
        box-shadow: 0 5px 25px rgba(0,0,0,0.08);
        border: none;
        padding: 1.5rem;
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
        transform: translateX(-5px);
    }

    .btn-edit-detail {
        background: linear-gradient(135deg, #ffc107 0%, #ff9800 100%);
        border: none;
        padding: 0.75rem 2rem;
        border-radius: 10px;
        color: white;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-edit-detail:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(255, 193, 7, 0.4);
        color: white;
    }

    .btn-delete-detail {
        background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
        border: none;
        padding: 0.75rem 2rem;
        border-radius: 10px;
        color: white;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-delete-detail:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(220, 53, 69, 0.4);
        color: white;
    }

    .divider {
        border-bottom: 2px solid #FFF8F0;
        margin: 1.5rem 0;
    }
</style>

<div class="page-header">
    <div class="d-flex align-items-center">
        <i class="bi bi-person-badge-fill me-3" style="font-size: 2rem;"></i>
        <div>
            <h2 class="mb-1 fw-bold">Detail Data Guru</h2>
            <p class="mb-0 opacity-75">Informasi lengkap data guru dan aktivitas mengajar</p>
        </div>
    </div>
</div>

<div class="row">
    {{-- CARD DATA GURU --}}
    <div class="col-lg-4 col-md-12 mb-4">
        <div class="card-modern">
            <div class="card-header-info card-header-modern">
                <h5><i class="bi bi-person-circle"></i> Informasi Pribadi</h5>
            </div>
            <div class="card-body">
                <div class="info-group">
                    <div class="info-label">NIP</div>
                    <div class="info-value" style="font-size: 1.2rem;">
                        <i class="bi bi-hash"></i>
                        {{ $guru->id_guru }}
                    </div>
                </div>

                <div class="divider"></div>

                <div class="info-group">
                    <div class="info-label">Nama Lengkap</div>
                    <div class="info-value" style="font-size: 1.2rem;">
                        <i class="bi bi-person-fill"></i>
                        {{ $guru->nama_guru }}
                    </div>
                </div>

                <div class="divider"></div>

                <div class="row">
                    <div class="col-12 mb-3">
                        <div class="info-group">
                            <div class="info-label">Jenis Kelamin</div>
                            <div class="info-value">
                                @if($guru->jenis_kelamin == 'Laki-laki')
                                    <i class="bi bi-gender-male gender-male"></i>
                                    <span class="gender-male">{{ $guru->jenis_kelamin }}</span>
                                @else
                                    <i class="bi bi-gender-female gender-female"></i>
                                    <span class="gender-female">{{ $guru->jenis_kelamin }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="info-group">
                            <div class="info-label">No. Telepon</div>
                            <div class="info-value">
                                <i class="bi bi-telephone-fill"></i>
                                {{ $guru->no_telp }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="divider"></div>

                <div class="info-group">
                    <div class="info-label">Alamat</div>
                    <div class="info-value">
                        <i class="bi bi-geo-alt-fill"></i>
                        {{ $guru->alamat }}
                    </div>
                </div>

                <div class="divider"></div>

                <div class="info-group mb-0">
                    <div class="info-label">Jabatan</div>
                    <div class="mt-2">
                        @if($guru->jabatan)
                            <span class="badge-jabatan-detail">
                                <i class="bi bi-award-fill"></i>
                                {{ $guru->jabatan->nama_jabatan }}
                            </span>
                        @else
                            <span class="badge-no-jabatan">
                                <i class="bi bi-dash-circle"></i>
                                Tidak ada jabatan
                            </span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- CARD DATA MENGAJAR & EKSTRAKURIKULER --}}
    <div class="col-lg-8 col-md-12">
        {{-- DATA MENGAJAR --}}
        <div class="card-modern mb-4">
            <div class="card-header-mengajar card-header-modern">
                <h5><i class="bi bi-book-fill"></i> Data Mengajar</h5>
            </div>
            <div class="card-body p-0">
                @if($guru->mengajar->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-custom align-middle mb-0">
                            <thead>
                                <tr>
                                    <th width="10%" class="text-center">No</th>
                                    <th width="50%"><i class="bi bi-journal-text me-1"></i> Mata Pelajaran</th>
                                    <th width="40%"><i class="bi bi-door-open me-1"></i> Kelas</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($guru->mengajar as $index => $mengajar)
                                <tr>
                                    <td class="text-center">
                                        <span class="no-badge">{{ $index + 1 }}</span>
                                    </td>
                                    <td>
                                        <span class="badge-mapel">
                                            {{ $mengajar->mata_pelajaran->nama_mata_pelajaran ?? '-' }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge-kelas">
                                            <i class="bi bi-mortarboard-fill me-1"></i>
                                            {{ $mengajar->kelas->nama_kelas ?? '-' }}
                                        </span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="empty-state">
                        <i class="bi bi-inbox"></i>
                        <p>Belum ada data mengajar</p>
                        <small class="text-muted">Guru ini belum mengampu mata pelajaran</small>
                    </div>
                @endif
            </div>
        </div>

        {{-- DATA MEMBINA EKSTRAKURIKULER --}}
        <div class="card-modern mb-4">
            <div class="card-header-ekskul card-header-modern">
                <h5><i class="bi bi-trophy-fill"></i> Data Membina Ekstrakurikuler</h5>
            </div>
            <div class="card-body p-0">
                @if($guru->membina->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-custom align-middle mb-0">
                            <thead>
                                <tr>
                                    <th width="15%" class="text-center">No</th>
                                    <th><i class="bi bi-stars me-1"></i> Nama Ekstrakurikuler</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($guru->membina as $index => $membina)
                                <tr>
                                    <td class="text-center">
                                        <span class="no-badge">{{ $index + 1 }}</span>
                                    </td>
                                    <td>
                                        <span class="badge-mapel">
                                            <i class="bi bi-star-fill me-1"></i>
                                            {{ $membina->ekstrakurikuler->nama_ekstrakurikuler ?? '-' }}
                                        </span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="empty-state">
                        <i class="bi bi-inbox"></i>
                        <p>Belum membina ekstrakurikuler</p>
                        <small class="text-muted">Guru ini belum membina kegiatan ekstrakurikuler</small>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

{{-- ACTION BUTTONS --}}
<div class="row mt-4">
    <div class="col-12">
        <div class="action-card">
            <div class="d-flex gap-3 justify-content-between flex-wrap">
                <a href="{{ route('guru.index') }}" class="btn btn-back">
                    <i class="bi bi-arrow-left me-2"></i> Kembali
                </a>
                <div class="d-flex gap-2 flex-wrap">
                    <a href="{{ route('guru.edit', $guru->id) }}" class="btn btn-edit-detail">
                        <i class="bi bi-pencil-square me-2"></i> Edit Data
                    </a>
                    <form action="{{ route('guru.destroy', $guru->id) }}" method="POST" class="d-inline" 
                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus data guru ini?\n\nData yang dihapus tidak dapat dikembalikan.')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-delete-detail">
                            <i class="bi bi-trash me-2"></i> Hapus Data
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection