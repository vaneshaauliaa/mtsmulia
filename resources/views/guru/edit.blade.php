@extends('layouts.app')

@section('title', 'Edit Data Guru')

@section('content')
<h4 class="mb-3 fw-semibold">Edit Data Guru</h4>

<div class="p-3 rounded" style="background:transparent;">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-body">

                    {{-- Progress Steps --}}
                    <div class="d-flex justify-content-between mb-4">
                        <div class="step-item active" id="step-indicator-1">
                            <div class="step-number">1</div>
                            <div class="step-title">Data Guru</div>
                        </div>
                        <div class="step-item" id="step-indicator-2">
                            <div class="step-number">2</div>
                            <div class="step-title">Data Mengajar</div>
                        </div>
                        <div class="step-item" id="step-indicator-3">
                            <div class="step-number">3</div>
                            <div class="step-title">Ekstrakurikuler</div>
                        </div>
                    </div>

                    <form action="{{ route('guru.update', $guru->id_guru) }}" method="POST" id="form-guru">
                        @csrf
                        @method('PUT')

                        {{-- SECTION 1: DATA GURU --}}
                        <div class="form-section active" id="section-1">
                            <h5 class="mb-4 fw-semibold text-primary">Data Guru</h5>

                            <div class="mb-3">
                                <label class="form-label">NIP</label>
                                <input type="text" class="form-control bg-light" name="id_guru" value="{{ old('id_guru', $guru->id_guru) }}" readonly>
                                <small class="text-muted">NIP tidak dapat diubah</small>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Nama Guru <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="nama_guru" value="{{ old('nama_guru', $guru->nama_guru) }}" required>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Jenis Kelamin <span class="text-danger">*</span></label>
                                    <select class="form-select" name="jenis_kelamin" required>
                                        <option value="" disabled>--Pilih Jenis Kelamin--</option>
                                        <option value="Laki-laki" {{ old('jenis_kelamin', $guru->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                        <option value="Perempuan" {{ old('jenis_kelamin', $guru->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                    </select>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">No Telp <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="no_telp" value="{{ old('no_telp', $guru->no_telp) }}" maxlength="13"
                                    inputmode="numeric" oninput="this.value = this.value.replace(/[^0-9]/g, '')" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Alamat <span class="text-danger">*</span></label>
                                <textarea class="form-control" name="alamat" rows="3" required>{{ old('alamat', $guru->alamat) }}</textarea>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Jabatan</label>
                                <select class="form-select" name="jabatan_id">
                                    <option value="">-- Pilih Jabatan --</option>
                                    @foreach($jabatan as $jbt)
                                        <option value="{{ $jbt->id }}" {{ old('jabatan_id', $guru->jabatan_id) == $jbt->id ? 'selected' : '' }}>
                                            {{ $jbt->nama_jabatan }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="d-flex justify-content-between mt-4">
                                <a href="{{ route('guru.index') }}" class="btn btn-secondary">Batal</a>
                                <button type="button" class="btn btn-primary" onclick="nextSection(2)">Selanjutnya →</button>
                            </div>
                        </div>

                        {{-- SECTION 2: DATA MENGAJAR --}}
                        <div class="form-section" id="section-2">
                            <h5 class="mb-4 fw-semibold text-primary">Data Mengajar</h5>

                            <div id="mengajar-wrapper">
                                @forelse($guru->mengajar as $index => $mengajar)
                                <div class="row mb-3 mengajar-row">
                                    <div class="col-md-5">
                                        <label class="form-label">Mata Pelajaran</label>
                                        <select name="mengajar[{{ $index }}][id_mata_pelajaran]" class="form-select">
                                            <option value="">-- Pilih Mata Pelajaran --</option>
                                            @foreach($mata_pelajaran as $mp)
                                                <option value="{{ $mp->id_mata_pelajaran }}" {{ $mengajar->id_mata_pelajaran == $mp->id_mata_pelajaran ? 'selected' : '' }}>
                                                    {{ $mp->nama_mata_pelajaran }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-5">
                                        <label class="form-label">Kelas</label>
                                        <select name="mengajar[{{ $index }}][id_kelas]" class="form-select">
                                            <option value="">-- Pilih Kelas --</option>
                                            @foreach($kelas as $kls)
                                                <option value="{{ $kls->id_kelas }}" {{ $mengajar->id_kelas == $kls->id_kelas ? 'selected' : '' }}>
                                                    {{ $kls->nama_kelas }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-2">
                                        <label class="form-label">&nbsp;</label>
                                        <button type="button" class="btn btn-danger w-100 remove-mengajar">Hapus</button>
                                    </div>
                                </div>
                                @empty
                                <div class="row mb-3 mengajar-row">
                                    <div class="col-md-5">
                                        <label class="form-label">Mata Pelajaran</label>
                                        <select name="mengajar[0][id_mata_pelajaran]" class="form-select">
                                            <option value="">-- Pilih Mata Pelajaran --</option>
                                            @foreach($mata_pelajaran as $mp)
                                                <option value="{{ $mp->id_mata_pelajaran }}">
                                                    {{ $mp->nama_mata_pelajaran }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-5">
                                        <label class="form-label">Kelas</label>
                                        <select name="mengajar[0][id_kelas]" class="form-select">
                                            <option value="">-- Pilih Kelas --</option>
                                            @foreach($kelas as $kls)
                                                <option value="{{ $kls->id_kelas }}">
                                                    {{ $kls->nama_kelas }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-2">
                                        <label class="form-label">&nbsp;</label>
                                        <button type="button" class="btn btn-danger w-100 remove-mengajar">Hapus</button>
                                    </div>
                                </div>
                                @endforelse
                            </div>

                            <button type="button" class="btn btn-outline-primary mb-4" id="add-mengajar">
                                <i class="bi bi-plus-circle"></i> Tambah Mengajar
                            </button>

                            <div class="d-flex justify-content-between mt-4">
                                <button type="button" class="btn btn-secondary" onclick="prevSection(1)">← Sebelumnya</button>
                                <button type="button" class="btn btn-primary" onclick="nextSection(3)">Selanjutnya →</button>
                            </div>
                        </div>

                        {{-- SECTION 3: DATA MEMBINA EKSTRAKURIKULER --}}
                        <div class="form-section" id="section-3">
                            <h5 class="mb-4 fw-semibold text-primary">Data Membina Ekstrakurikuler</h5>

                            <div id="membina-wrapper">
                                @forelse($guru->membina as $index => $membina)
                                <div class="row mb-3 membina-row">
                                    <div class="col-md-10">
                                        <label class="form-label">Ekstrakurikuler</label>
                                        <select name="membina[{{ $index }}][id_ekstrakurikuler]" class="form-select">
                                            <option value="">-- Pilih Ekstrakurikuler --</option>
                                            @foreach($ekstrakurikuler as $ekskul)
                                                <option value="{{ $ekskul->id_ekstrakurikuler }}" {{ $membina->id_ekstrakurikuler == $ekskul->id_ekstrakurikuler ? 'selected' : '' }}>
                                                    {{ $ekskul->nama_ekstrakurikuler }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-2">
                                        <label class="form-label">&nbsp;</label>
                                        <button type="button" class="btn btn-danger w-100 remove-membina">Hapus</button>
                                    </div>
                                </div>
                                @empty
                                <div class="row mb-3 membina-row">
                                    <div class="col-md-10">
                                        <label class="form-label">Ekstrakurikuler</label>
                                        <select name="membina[0][id_ekstrakurikuler]" class="form-select">
                                            <option value="">-- Pilih Ekstrakurikuler --</option>
                                            @foreach($ekstrakurikuler as $ekskul)
                                                <option value="{{ $ekskul->id_ekstrakurikuler }}">
                                                    {{ $ekskul->nama_ekstrakurikuler }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-2">
                                        <label class="form-label">&nbsp;</label>
                                        <button type="button" class="btn btn-danger w-100 remove-membina">Hapus</button>
                                    </div>
                                </div>
                                @endforelse
                            </div>

                            <button type="button" class="btn btn-outline-primary mb-4" id="add-membina">
                                <i class="bi bi-plus-circle"></i> Tambah Ekstrakurikuler
                            </button>

                            <div class="d-flex justify-content-between mt-4">
                                <button type="button" class="btn btn-secondary" onclick="prevSection(2)">← Sebelumnya</button>
                                <button type="submit" class="btn btn-success">
                                    <i class="bi bi-check-circle"></i> Update Data
                                </button>
                            </div>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

{{-- STYLES --}}
<style>
.step-item {
    flex: 1;
    text-align: center;
    position: relative;
    padding: 10px;
}

.step-item:not(:last-child)::after {
    content: '';
    position: absolute;
    top: 25px;
    right: -50%;
    width: 100%;
    height: 2px;
    background: #dee2e6;
    z-index: -1;
}

.step-item.active:not(:last-child)::after {
    background: #0d6efd;
}

.step-item.completed:not(:last-child)::after {
    background: #198754;
}

.step-number {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: #dee2e6;
    color: #6c757d;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    margin-bottom: 8px;
    transition: all 0.3s;
}

.step-item.active .step-number {
    background: #0d6efd;
    color: white;
    transform: scale(1.1);
}

.step-item.completed .step-number {
    background: #198754;
    color: white;
}

.step-title {
    font-size: 12px;
    font-weight: 500;
    color: #6c757d;
}

.step-item.active .step-title {
    color: #0d6efd;
    font-weight: 600;
}

.step-item.completed .step-title {
    color: #198754;
}

.form-section {
    display: none;
}

.form-section.active {
    display: block;
    animation: fadeIn 0.3s;
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>

{{-- SCRIPTS --}}
<script>
// Index untuk mengajar
let mengajarIndex = {{ count($guru->mengajar) > 0 ? count($guru->mengajar) : 1 }};

document.getElementById('add-mengajar').addEventListener('click', function () {
    let wrapper = document.getElementById('mengajar-wrapper');

    let row = `
    <div class="row mb-3 mengajar-row">
        <div class="col-md-5">
            <label class="form-label">Mata Pelajaran</label>
            <select name="mengajar[${mengajarIndex}][id_mata_pelajaran]" class="form-select">
                <option value="">-- Pilih Mata Pelajaran --</option>
                @foreach($mata_pelajaran as $mp)
                    <option value="{{ $mp->id_mata_pelajaran }}">{{ $mp->nama_mata_pelajaran }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-5">
            <label class="form-label">Kelas</label>
            <select name="mengajar[${mengajarIndex}][id_kelas]" class="form-select">
                <option value="">-- Pilih Kelas --</option>
                @foreach($kelas as $kls)
                    <option value="{{ $kls->id_kelas }}">{{ $kls->nama_kelas }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-2">
            <label class="form-label">&nbsp;</label>
            <button type="button" class="btn btn-danger w-100 remove-mengajar">Hapus</button>
        </div>
    </div>
    `;

    wrapper.insertAdjacentHTML('beforeend', row);
    mengajarIndex++;
});

document.addEventListener('click', function (e) {
    if (e.target.classList.contains('remove-mengajar')) {
        e.target.closest('.mengajar-row').remove();
    }
});

// Index untuk membina ekstrakurikuler
let membinaIndex = {{ count($guru->membina) > 0 ? count($guru->membina) : 1 }};

document.getElementById('add-membina').addEventListener('click', function () {
    let wrapper = document.getElementById('membina-wrapper');

    let row = `
    <div class="row mb-3 membina-row">
        <div class="col-md-10">
            <label class="form-label">Ekstrakurikuler</label>
            <select name="membina[${membinaIndex}][id_ekstrakurikuler]" class="form-select">
                <option value="">-- Pilih Ekstrakurikuler --</option>
                @foreach($ekstrakurikuler as $ekskul)
                    <option value="{{ $ekskul->id_ekstrakurikuler }}">{{ $ekskul->nama_ekstrakurikuler }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-2">
            <label class="form-label">&nbsp;</label>
            <button type="button" class="btn btn-danger w-100 remove-membina">Hapus</button>
        </div>
    </div>
    `;

    wrapper.insertAdjacentHTML('beforeend', row);
    membinaIndex++;
});

document.addEventListener('click', function (e) {
    if (e.target.classList.contains('remove-membina')) {
        e.target.closest('.membina-row').remove();
    }
});

// Navigation between sections
function nextSection(sectionNumber) {
    // Hide current section
    document.querySelectorAll('.form-section').forEach(section => {
        section.classList.remove('active');
    });

    // Show next section
    document.getElementById('section-' + sectionNumber).classList.add('active');

    // Update step indicators
    updateStepIndicators(sectionNumber);

    // Scroll to top
    window.scrollTo({ top: 0, behavior: 'smooth' });
}

function prevSection(sectionNumber) {
    // Hide current section
    document.querySelectorAll('.form-section').forEach(section => {
        section.classList.remove('active');
    });

    // Show previous section
    document.getElementById('section-' + sectionNumber).classList.add('active');

    // Update step indicators
    updateStepIndicators(sectionNumber);

    // Scroll to top
    window.scrollTo({ top: 0, behavior: 'smooth' });
}

function updateStepIndicators(currentSection) {
    // Remove all active and completed classes
    document.querySelectorAll('.step-item').forEach((step, index) => {
        step.classList.remove('active', 'completed');
        
        if (index + 1 < currentSection) {
            step.classList.add('completed');
        } else if (index + 1 === currentSection) {
            step.classList.add('active');
        }
    });
}
</script>

@endsection