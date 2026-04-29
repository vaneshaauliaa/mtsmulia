@extends('layouts.app')

@section('title', 'Tambah Data Guru')

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
        margin-bottom: 1.5rem;
    }

    .card-header-modern {
        background: linear-gradient(135deg, #FDFBF7 0%, #FFF8F0 100%);
        border-bottom: 2px solid #E0D5C7;
        padding: 1.5rem;
    }

    /* Progress Steps */
    .progress-container {
        background: white;
        border-radius: 16px;
        padding: 2rem;
        box-shadow: 0 5px 25px rgba(0,0,0,0.08);
        margin-bottom: 2rem;
    }

    .step-wrapper {
        display: flex;
        justify-content: space-between;
        align-items: center;
        position: relative;
    }

    .step-item {
        display: flex;
        flex-direction: column;
        align-items: center;
        position: relative;
        flex: 1;
        z-index: 1;
    }

    .step-number {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background: #E0D5C7;
        color: #6D4C41;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 1.25rem;
        margin-bottom: 0.75rem;
        transition: all 0.3s ease;
        border: 3px solid #E0D5C7;
    }

    .step-item.active .step-number {
        background: linear-gradient(135deg, #8B4513 0%, #D2691E 100%);
        color: white;
        border-color: #8B4513;
        box-shadow: 0 4px 15px rgba(139, 69, 19, 0.3);
        transform: scale(1.1);
    }

    .step-item.completed .step-number {
        background: linear-gradient(135deg, #8B6914 0%, #CD853F 100%);
        color: white;
        border-color: #8B6914;
    }

    .step-label {
        font-size: 0.875rem;
        color: #6D4C41;
        text-align: center;
        font-weight: 500;
    }

    .step-item.active .step-label {
        color: #8B4513;
        font-weight: 700;
    }

    .step-item.completed .step-label {
        color: #8B6914;
        font-weight: 600;
    }

    .step-line {
        position: absolute;
        top: 25px;
        left: 0;
        right: 0;
        height: 3px;
        background: #E0D5C7;
        z-index: 0;
    }

    .step-line-progress {
        height: 100%;
        background: linear-gradient(135deg, #8B4513 0%, #D2691E 100%);
        transition: width 0.3s ease;
        width: 0%;
    }

    /* Form Styles */
    .form-label {
        color: #5D4037;
        font-weight: 600;
        font-size: 0.875rem;
        margin-bottom: 0.5rem;
    }

    .form-label .text-danger {
        color: #dc3545;
    }

    .form-control, .form-select {
        border: 2px solid #E0D5C7;
        border-radius: 10px;
        padding: 0.6rem 1rem;
        font-size: 0.875rem;
        transition: all 0.3s ease;
    }

    .form-control:focus, .form-select:focus {
        border-color: #8B4513;
        box-shadow: 0 0 0 0.2rem rgba(139, 69, 19, 0.15);
        outline: none;
    }

    .form-control.is-invalid, .form-select.is-invalid {
        border-color: #dc3545;
    }

    .invalid-feedback {
        color: #dc3545;
        font-size: 0.75rem;
        margin-top: 0.25rem;
    }

    /* Buttons */
    .btn-primary-custom {
        background: linear-gradient(135deg, #8B4513 0%, #D2691E 100%);
        border: none;
        padding: 0.6rem 1.5rem;
        border-radius: 10px;
        color: white;
        font-weight: 600;
        font-size: 0.875rem;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(139, 69, 19, 0.3);
    }

    .btn-primary-custom:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(139, 69, 19, 0.4);
        color: white;
    }

    .btn-secondary-custom {
        background: white;
        border: 2px solid #E0D5C7;
        padding: 0.6rem 1.5rem;
        border-radius: 10px;
        color: #6D4C41;
        font-weight: 600;
        font-size: 0.875rem;
        transition: all 0.3s ease;
    }

    .btn-secondary-custom:hover {
        background: #FFF8F0;
        border-color: #8B4513;
        color: #8B4513;
    }

    .btn-success-custom {
        background: linear-gradient(135deg, #198754 0%, #20c997 100%);
        border: none;
        padding: 0.6rem 1.5rem;
        border-radius: 10px;
        color: white;
        font-weight: 600;
        font-size: 0.875rem;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(25, 135, 84, 0.3);
    }

    .btn-success-custom:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(25, 135, 84, 0.4);
        color: white;
    }

    .btn-add-custom {
        background: linear-gradient(135deg, #8B6914 0%, #CD853F 100%);
        border: none;
        padding: 0.5rem 1rem;
        border-radius: 8px;
        color: white;
        font-weight: 600;
        font-size: 0.875rem;
        transition: all 0.3s ease;
    }

    .btn-add-custom:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(139, 105, 20, 0.4);
        color: white;
    }

    .btn-danger-custom {
        background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
        border: none;
        padding: 0.5rem 1rem;
        border-radius: 8px;
        color: white;
        font-weight: 600;
        font-size: 0.875rem;
        transition: all 0.3s ease;
    }

    .btn-danger-custom:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(220, 53, 69, 0.4);
        color: white;
    }

    /* Dynamic Item */
    .dynamic-item {
        background: #FFF8F0;
        border: 2px solid #E0D5C7;
        border-radius: 12px;
        padding: 1.25rem;
        margin-bottom: 1rem;
        transition: all 0.3s ease;
    }

    .dynamic-item:hover {
        box-shadow: 0 4px 15px rgba(139, 69, 19, 0.1);
        border-color: #8B4513;
    }

    /* Section Divider */
    .section-divider {
        border-top: 2px dashed #E0D5C7;
        margin: 2rem 0;
        padding-top: 2rem;
    }

    .subsection-title {
        color: #D2691E;
        font-weight: 600;
        font-size: 1.1rem;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
    }

    .subsection-title i {
        margin-right: 0.5rem;
    }

    /* Animation */
    .form-section {
        animation: fadeIn 0.4s ease;
    }

    @keyframes fadeIn {
        from { 
            opacity: 0; 
            transform: translateY(20px); 
        }
        to { 
            opacity: 1; 
            transform: translateY(0); 
        }
    }

    .section-title {
        color: #8B4513;
        font-weight: 700;
        font-size: 1.25rem;
        margin-bottom: 0;
    }
</style>

<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h2 class="mb-1 fw-bold">➕ Tambah Data Guru</h2>
            <p class="mb-0 opacity-75">Lengkapi formulir untuk menambahkan guru baru</p>
        </div>
    </div>
</div>

{{-- Progress Steps --}}
<div class="progress-container">
    <div class="step-wrapper">
        <div class="step-line">
            <div class="step-line-progress" id="progressLine"></div>
        </div>
        
        <div class="step-item active" id="step-indicator-1">
            <div class="step-number">1</div>
            <div class="step-label">Data Guru</div>
        </div>
        
        <div class="step-item" id="step-indicator-2">
            <div class="step-number">2</div>
            <div class="step-label">Mengajar & Ekstrakurikuler</div>
        </div>
    </div>
</div>

<form method="POST" action="{{ route('guru.store') }}" id="formGuru">
    @csrf

    {{-- SECTION 1: DATA GURU --}}
    <div class="card-modern form-section" id="section-1">
        <div class="card-header-modern">
            <h5 class="section-title">
                <i class="bi bi-person-circle me-2"></i>Data Guru
            </h5>
        </div>
        <div class="card-body p-4">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="id_guru" class="form-label">
                        NIP <span class="text-danger">*</span>
                    </label>
                    <input type="text" 
                           class="form-control @error('id_guru') is-invalid @enderror" 
                           id="id_guru" 
                           name="id_guru" 
                           value="{{ old('id_guru') }}" 
                           placeholder="Masukkan NIP"
                           required>
                    @error('id_guru')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="nama_guru" class="form-label">
                        Nama Guru <span class="text-danger">*</span>
                    </label>
                    <input type="text" 
                           class="form-control @error('nama_guru') is-invalid @enderror" 
                           id="nama_guru" 
                           name="nama_guru" 
                           value="{{ old('nama_guru') }}" 
                           placeholder="Masukkan nama lengkap"
                           required>
                    @error('nama_guru')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="jenis_kelamin" class="form-label">
                        Jenis Kelamin <span class="text-danger">*</span>
                    </label>
                    <select class="form-select @error('jenis_kelamin') is-invalid @enderror" 
                            id="jenis_kelamin" 
                            name="jenis_kelamin" 
                            required>
                        <option value="">--Pilih Jenis Kelamin--</option>
                        <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                    @error('jenis_kelamin')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="no_telp" class="form-label">
                        No Telp <span class="text-danger">*</span>
                    </label>
                    <input type="text" 
                           class="form-control @error('no_telp') is-invalid @enderror" 
                           id="no_telp" 
                           name="no_telp" 
                           value="{{ old('no_telp') }}" 
                           placeholder="Contoh: 08123456789"
                           maxlength="13"
                           inputmode="numeric"
                           oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                           required>
                    @error('no_telp')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-12 mb-3">
                    <label for="alamat" class="form-label">
                        Alamat <span class="text-danger">*</span>
                    </label>
                    <textarea class="form-control @error('alamat') is-invalid @enderror" 
                              id="alamat" 
                              name="alamat" 
                              rows="3" 
                              placeholder="Masukkan alamat lengkap"
                              required>{{ old('alamat') }}</textarea>
                    @error('alamat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="jabatan_id" class="form-label">Jabatan</label>
                    <select class="form-select @error('jabatan_id') is-invalid @enderror" 
                            id="jabatan_id" 
                            name="jabatan_id">
                        <option value="">-- Pilih Jabatan --</option>
                        @foreach($jabatan as $jbt)
                            <option value="{{ $jbt->id }}" {{ old('jabatan_id') == $jbt->id ? 'selected' : '' }}>
                                {{ $jbt->nama_jabatan }}
                            </option>
                        @endforeach
                    </select>
                    @error('jabatan_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="d-flex justify-content-between mt-4">
                <a href="{{ route('guru.index') }}" class="btn btn-secondary-custom">
                    <i class="bi bi-x-circle me-2"></i>Batal
                </a>
                <button type="button" class="btn btn-primary-custom" onclick="nextSection(2)">
                    Selanjutnya <i class="bi bi-arrow-right ms-2"></i>
                </button>
            </div>
        </div>
    </div>

    {{-- SECTION 2: DATA MENGAJAR & EKSTRAKURIKULER --}}
    <div class="card-modern form-section" id="section-2" style="display: none;">
        <div class="card-header-modern">
            <h5 class="section-title">
                <i class="bi bi-book me-2"></i>Data Mengajar & Ekstrakurikuler
            </h5>
        </div>
        <div class="card-body p-4">
            {{-- SUBSECTION: DATA MENGAJAR --}}
            <div class="subsection-title">
                <i class="bi bi-journal-text"></i>
                Data Mengajar
            </div>

            <div id="mengajar-wrapper">
                <div class="dynamic-item mengajar-row">
                    <div class="row align-items-end">
                        <div class="col-md-5 mb-3 mb-md-0">
                            <label class="form-label">Mata Pelajaran</label>
                            <select class="form-select" name="mengajar[0][id_mata_pelajaran]">
                                <option value="">-- Pilih Mata Pelajaran --</option>
                                @foreach($mata_pelajaran as $mp)
                                    <option value="{{ $mp->id_mata_pelajaran }}">{{ $mp->nama_mata_pelajaran }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-5 mb-3 mb-md-0">
                            <label class="form-label">Kelas</label>
                            <select class="form-select" name="mengajar[0][id_kelas]">
                                <option value="">-- Pilih Kelas --</option>
                                @foreach($kelas as $kls)
                                    <option value="{{ $kls->id_kelas }}">{{ $kls->nama_kelas }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-2">
                            <button type="button" 
                                    class="btn btn-danger-custom w-100 remove-mengajar">
                                <i class="bi bi-trash"></i> Hapus
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <button type="button" class="btn btn-add-custom mt-3" id="add-mengajar">
                <i class="bi bi-plus-circle me-2"></i>Tambah Mengajar
            </button>

            {{-- DIVIDER --}}
            <div class="section-divider"></div>

            {{-- SUBSECTION: DATA MEMBINA EKSTRAKURIKULER --}}
            <div class="subsection-title">
                <i class="bi bi-trophy-fill"></i>
                Data Membina Ekstrakurikuler
            </div>

            <div id="membina-wrapper">
                <div class="dynamic-item membina-row">
                    <div class="row align-items-end">
                        <div class="col-md-10 mb-3 mb-md-0">
                            <label class="form-label">Ekstrakurikuler</label>
                            <select class="form-select" name="membina[0][id_ekstrakurikuler]">
                                <option value="">-- Pilih Ekstrakurikuler --</option>
                                @foreach($ekstrakurikuler as $ekskul)
                                    <option value="{{ $ekskul->id_ekstrakurikuler }}">{{ $ekskul->nama_ekstrakurikuler }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-2">
                            <button type="button" 
                                    class="btn btn-danger-custom w-100 remove-membina">
                                <i class="bi bi-trash"></i> Hapus
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <button type="button" class="btn btn-add-custom mt-3" id="add-membina">
                <i class="bi bi-plus-circle me-2"></i>Tambah Ekstrakurikuler
            </button>

            <div class="d-flex justify-content-between mt-4 pt-4 border-top">
                <button type="button" class="btn btn-secondary-custom" onclick="prevSection(1)">
                    <i class="bi bi-arrow-left me-2"></i>Sebelumnya
                </button>
                <button type="submit" class="btn btn-success-custom">
                    <i class="bi bi-check-circle me-2"></i>Simpan Data
                </button>
            </div>
        </div>
    </div>
</form>

<script>
    let currentSection = 1;
    let mengajarIndex = 1;
    let membinaIndex = 1;

    function updateProgress() {
        const progress = ((currentSection - 1) / 1) * 100; // 2 steps: 0% or 100%
        document.getElementById('progressLine').style.width = progress + '%';
    }

    function nextSection(section) {
        // Validasi section saat ini
        if (!validateCurrentSection()) {
            return;
        }

        // Hide current section
        document.getElementById(`section-${currentSection}`).style.display = 'none';
        document.getElementById(`step-indicator-${currentSection}`).classList.remove('active');
        document.getElementById(`step-indicator-${currentSection}`).classList.add('completed');
        
        // Show next section
        currentSection = section;
        document.getElementById(`section-${currentSection}`).style.display = 'block';
        document.getElementById(`step-indicator-${currentSection}`).classList.add('active');
        
        updateProgress();
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    function prevSection(section) {
        // Hide current section
        document.getElementById(`section-${currentSection}`).style.display = 'none';
        document.getElementById(`step-indicator-${currentSection}`).classList.remove('active');
        
        // Show previous section
        currentSection = section;
        document.getElementById(`section-${currentSection}`).style.display = 'block';
        document.getElementById(`step-indicator-${currentSection}`).classList.remove('completed');
        document.getElementById(`step-indicator-${currentSection}`).classList.add('active');
        
        updateProgress();
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    function validateCurrentSection() {
        const section = document.getElementById(`section-${currentSection}`);
        const requiredInputs = section.querySelectorAll('[required]');
        let isValid = true;

        requiredInputs.forEach(input => {
            if (!input.value.trim()) {
                input.classList.add('is-invalid');
                isValid = false;
            } else {
                input.classList.remove('is-invalid');
            }
        });

        if (!isValid) {
            alert('⚠️ Mohon lengkapi semua field yang wajib diisi!');
        }

        return isValid;
    }

    // Add Mengajar
    document.getElementById('add-mengajar').addEventListener('click', function () {
        let wrapper = document.getElementById('mengajar-wrapper');
        
        let row = `
        <div class="dynamic-item mengajar-row">
            <div class="row align-items-end">
                <div class="col-md-5 mb-3 mb-md-0">
                    <label class="form-label">Mata Pelajaran</label>
                    <select class="form-select" name="mengajar[${mengajarIndex}][id_mata_pelajaran]">
                        <option value="">-- Pilih Mata Pelajaran --</option>
                        @foreach($mata_pelajaran as $mp)
                            <option value="{{ $mp->id_mata_pelajaran }}">{{ $mp->nama_mata_pelajaran }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-5 mb-3 mb-md-0">
                    <label class="form-label">Kelas</label>
                    <select class="form-select" name="mengajar[${mengajarIndex}][id_kelas]">
                        <option value="">-- Pilih Kelas --</option>
                        @foreach($kelas as $kls)
                            <option value="{{ $kls->id_kelas }}">{{ $kls->nama_kelas }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-2">
                    <button type="button" class="btn btn-danger-custom w-100 remove-mengajar">
                        <i class="bi bi-trash"></i> Hapus
                    </button>
                </div>
            </div>
        </div>
        `;

        wrapper.insertAdjacentHTML('beforeend', row);
        mengajarIndex++;
    });

    // Remove Mengajar
    document.addEventListener('click', function (e) {
        if (e.target.classList.contains('remove-mengajar') || e.target.closest('.remove-mengajar')) {
            const button = e.target.classList.contains('remove-mengajar') ? e.target : e.target.closest('.remove-mengajar');
            button.closest('.mengajar-row').remove();
        }
    });

    // Add Membina
    document.getElementById('add-membina').addEventListener('click', function () {
        let wrapper = document.getElementById('membina-wrapper');

        let row = `
        <div class="dynamic-item membina-row">
            <div class="row align-items-end">
                <div class="col-md-10 mb-3 mb-md-0">
                    <label class="form-label">Ekstrakurikuler</label>
                    <select class="form-select" name="membina[${membinaIndex}][id_ekstrakurikuler]">
                        <option value="">-- Pilih Ekstrakurikuler --</option>
                        @foreach($ekstrakurikuler as $ekskul)
                            <option value="{{ $ekskul->id_ekstrakurikuler }}">{{ $ekskul->nama_ekstrakurikuler }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-2">
                    <button type="button" class="btn btn-danger-custom w-100 remove-membina">
                        <i class="bi bi-trash"></i> Hapus
                    </button>
                </div>
            </div>
        </div>
        `;

        wrapper.insertAdjacentHTML('beforeend', row);
        membinaIndex++;
    });

    // Remove Membina
    document.addEventListener('click', function (e) {
        if (e.target.classList.contains('remove-membina') || e.target.closest('.remove-membina')) {
            const button = e.target.classList.contains('remove-membina') ? e.target : e.target.closest('.remove-membina');
            button.closest('.membina-row').remove();
        }
    });

    // Remove invalid class on input
    document.addEventListener('DOMContentLoaded', function() {
        const inputs = document.querySelectorAll('.form-control, .form-select');
        inputs.forEach(input => {
            input.addEventListener('input', function() {
                if (this.value.trim()) {
                    this.classList.remove('is-invalid');
                }
            });
        });
    });
</script>

@endsection