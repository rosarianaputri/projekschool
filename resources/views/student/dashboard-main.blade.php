<!-- Page Header -->
<div class="nxl-head mb-5">
    <div class="nxl-head-content">
        <h2 class="nxl-title mb-2">Selamat Datang, {{ auth()->user()->name }}!</h2>
        <p class="nxl-head-text">Kelola pendaftaran, berkas, dan materi pembelajaran Anda di sini</p>
    </div>
</div>

<!-- Welcome Card -->
<div class="row mb-4">
    <div class="col-lg-12">
        <div class="card border-0 bg-light-primary shadow-sm">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                    <div>
                        <h5 class="text-dark mb-2">Halo {{ auth()->user()->name }}! 👋</h5>
                        <p class="text-muted mb-0">
                            Pastikan semua formulir, berkas, dan materi pembelajaran Anda sudah dicek secara berkala.
                        </p>
                    </div>
                    <div class="welcome-icon-wrap">
                        <i class="feather-check-circle fs-50 text-primary opacity-75"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mb-4">
    <div class="col-lg-6 mb-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <h5 class="text-dark mb-3">
                    <i class="feather-layers me-2 text-primary"></i>Kelas Saya
                </h5>

                @if(isset($studentClass) && $studentClass && $studentClass->class)
                    <h4 class="mb-1">{{ $studentClass->class->name }}</h4>
                    <p class="text-muted mb-2">{{ $studentClass->class->subject ?: 'Mata pelajaran belum diatur' }}</p>
                    <p class="mb-1"><strong>Guru:</strong> {{ $studentClass->class->teacher->name ?? '-' }}</p>
                    <p class="mb-0"><strong>Ruang:</strong> {{ $studentClass->class->room ?? '-' }}</p>
                @else
                    <p class="text-muted mb-0">Anda belum ditempatkan ke kelas oleh admin.</p>
                @endif
            </div>
        </div>
    </div>

    <div class="col-lg-6 mb-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <h5 class="text-dark mb-0">
                        <i class="feather-calendar me-2 text-info"></i>Jadwal Terdekat
                    </h5>
                    <a href="{{ route('student.schedule') }}" class="btn btn-sm btn-outline-primary">
                        Lihat Semua
                    </a>
                </div>

                @if(isset($recentSchedules) && $recentSchedules->count())
                    @foreach($recentSchedules->take(3) as $schedule)
                        <div class="border rounded-3 p-3 mb-2">
                            <div class="fw-semibold">{{ $schedule->day }}</div>
                            <div class="text-muted small">
                                {{ $schedule->start_time }} - {{ $schedule->end_time }}
                            </div>
                            <div class="text-muted small">
                                Ruang: {{ $schedule->room ?: '-' }}
                            </div>
                        </div>
                    @endforeach
                @else
                    <p class="text-muted mb-0">Belum ada jadwal untuk akun ini.</p>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Materi Terbaru -->
<div class="row mt-2 mb-4">
    <div class="col-lg-12">
        <div class="card border-0 shadow-sm dashboard-section-card">
            <div class="card-body">
                <div class="d-flex flex-column flex-lg-row align-items-start align-items-lg-center justify-content-between gap-3 mb-4">
                    <div>
                        <h5 class="text-dark mb-1 fw-semibold">
                            <i class="feather-book-open me-2 text-warning"></i>Materi Terbaru
                        </h5>
                        <p class="text-muted mb-0">Materi terbaru dari guru yang sesuai dengan kelas Anda.</p>
                    </div>
                    <a href="{{ route('student.materials') }}" class="btn btn-sm btn-outline-primary px-3">
                        Lihat Semua
                    </a>
                </div>

                @if(isset($recentMaterials) && $recentMaterials->count())
                    <div class="row g-3">
                        @foreach($recentMaterials as $material)
                            <div class="col-lg-4 col-md-6">
                                <div class="card border-0 shadow-sm h-100 transition-all material-preview-card">
                                    <div class="card-body d-flex flex-column">
                                        <div class="d-flex justify-content-between align-items-start mb-3">
                                            <span class="badge bg-light text-dark border px-3 py-2">
                                                {{ $material->type ?: 'Materi' }}
                                            </span>
                                            <small class="text-muted">{{ $material->created_at->format('d M Y') }}</small>
                                        </div>

                                        <h6 class="text-dark mb-2 fw-semibold">{{ $material->title }}</h6>
                                        <p class="text-muted small mb-2">
                                            Kelas: {{ $material->class->name ?? '-' }}
                                        </p>

                                        <p class="text-muted small mb-3 flex-grow-1">
                                            {{ \Illuminate\Support\Str::limit($material->notes ?: 'Belum ada deskripsi tambahan untuk materi ini.', 100) }}
                                        </p>

                                        @if($material->link)
                                            <a href="{{ $material->link }}" target="_blank" class="btn btn-sm btn-primary mt-auto">
                                                <i class="feather-external-link me-1"></i> Buka Materi
                                            </a>
                                        @else
                                            <button class="btn btn-sm btn-light border mt-auto" disabled>
                                                Link belum tersedia
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-4">
                        <div class="avatar-text rounded-circle bg-light-warning d-inline-flex align-items-center justify-content-center mb-3 mx-auto"
                             style="width: 64px; height: 64px;">
                            <i class="feather-book-open fs-24 text-warning"></i>
                        </div>
                        <h6 class="text-dark mb-2">Belum Ada Materi</h6>
                        <p class="text-muted mb-0">Belum ada materi yang tersedia untuk akun ini.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

@if (!$application)
    <div class="alert alert-warning mb-4 border-0 shadow-sm" role="alert">
        <i class="feather-alert-circle me-2"></i>
        Data pendaftaran belum ada. Silakan isi formulir pendaftaran terlebih dahulu.
    </div>
@elseif ($documentSummary && !$documentSummary['is_complete'])
    <div class="alert alert-info mb-4 border-0 shadow-sm" role="alert">
        <i class="feather-info me-2"></i>
        Berkas belum lengkap: {{ $documentSummary['uploaded_required'] }}/{{ $documentSummary['required_total'] }} dokumen wajib sudah diupload.
    </div>
@else
    <div class="alert alert-success mb-4 border-0 shadow-sm" role="alert">
        <i class="feather-check-circle me-2"></i>
        Berkas persyaratan Anda sudah lengkap.
    </div>
@endif

<!-- Main Dashboard Cards -->
<div class="row">
    <!-- Formulir Pendaftaran -->
    <div class="col-lg-4 col-md-6 mb-4">
        <a href="{{ route('student.formulir') }}" class="card border-0 shadow-sm h-100 transition-all text-decoration-none dashboard-feature-card">
            <div class="card-body text-center d-flex flex-column justify-content-center">
                <div class="avatar-text rounded-circle bg-light-primary d-inline-flex align-items-center justify-content-center mb-3 mx-auto"
                     style="width: 65px; height: 65px;">
                    <i class="feather-file-text fs-24 text-primary"></i>
                </div>
                <h5 class="text-dark mb-2 fw-semibold">Formulir Pendaftaran</h5>
                <p class="text-muted small mb-0">
                    Isi formulir pendaftaran siswa baru untuk memulai proses registrasi.
                </p>
                <div class="mt-3">
                    @if ($application)
                        <span class="badge bg-success px-3 py-2">Formulir Sudah Diisi</span>
                    @else
                        <span class="badge bg-primary px-3 py-2">Buka Formulir</span>
                    @endif
                </div>
            </div>
        </a>
    </div>

    <!-- Upload Berkas -->
    <div class="col-lg-4 col-md-6 mb-4">
        <a href="{{ route('student.upload') }}" class="card border-0 shadow-sm h-100 transition-all text-decoration-none dashboard-feature-card">
            <div class="card-body text-center d-flex flex-column justify-content-center">
                <div class="avatar-text rounded-circle bg-light-success d-inline-flex align-items-center justify-content-center mb-3 mx-auto"
                     style="width: 65px; height: 65px;">
                    <i class="feather-upload-cloud fs-24 text-success"></i>
                </div>
                <h5 class="text-dark mb-2 fw-semibold">Upload Berkas</h5>
                <p class="text-muted small mb-0">
                    Unggah dokumen persyaratan yang diperlukan untuk melengkapi pendaftaran Anda.
                </p>
                <div class="mt-3">
                    @if ($documentSummary && $documentSummary['is_complete'])
                        <span class="badge bg-success px-3 py-2">Berkas Lengkap</span>
                    @elseif ($documentSummary)
                        <span class="badge bg-warning text-dark px-3 py-2">
                            {{ $documentSummary['uploaded_required'] }}/{{ $documentSummary['required_total'] }} Wajib
                        </span>
                    @else
                        <span class="badge bg-secondary px-3 py-2">Isi Formulir Dulu</span>
                    @endif
                </div>
            </div>
        </a>
    </div>

    <!-- Materi Pembelajaran -->
    <div class="col-lg-4 col-md-6 mb-4">
        <a href="{{ route('student.materials') }}" class="card border-0 shadow-sm h-100 transition-all text-decoration-none dashboard-feature-card">
            <div class="card-body text-center d-flex flex-column justify-content-center">
                <div class="avatar-text rounded-circle bg-light-warning d-inline-flex align-items-center justify-content-center mb-3 mx-auto"
                     style="width: 65px; height: 65px;">
                    <i class="feather-book-open fs-22 text-warning"></i>
                </div>

                <h5 class="text-dark mb-2 fw-semibold">Materi Pembelajaran</h5>

                <p class="text-muted small mb-0">
                    Akses materi dari guru sesuai dengan kelas Anda.
                </p>

                <div class="mt-3">
                    @if(isset($recentMaterials) && $recentMaterials->count())
                        <span class="badge bg-warning text-dark px-3 py-2">
                            {{ $recentMaterials->count() }} Materi Baru
                        </span>
                    @else
                        <span class="badge bg-light text-muted border px-3 py-2">
                            Belum Ada Materi
                        </span>
                    @endif
                </div>
            </div>
        </a>
    </div>

    <!-- Status Pendaftaran -->
    <div class="col-lg-4 col-md-6 mb-4">
        <a href="{{ route('student.status') }}" class="card border-0 shadow-sm h-100 transition-all text-decoration-none dashboard-feature-card">
            <div class="card-body text-center d-flex flex-column justify-content-center">
                <div class="avatar-text rounded-circle bg-light-info d-inline-flex align-items-center justify-content-center mb-3 mx-auto"
                     style="width: 65px; height: 65px;">
                    <i class="feather-clock fs-24 text-info"></i>
                </div>
                <h5 class="text-dark mb-2 fw-semibold">Status Pendaftaran</h5>
                <p class="text-muted small mb-0">
                    Periksa status verifikasi dan hasil seleksi aplikasi pendaftaran Anda.
                </p>
                <div class="mt-3">
                    <span class="badge bg-info px-3 py-2">Cek Status</span>
                </div>
            </div>
        </a>
    </div>
</div>

<!-- Tahapan PPDB Section -->
<div class="row mt-5 mb-5">
    <div class="col-lg-12">
        <h5 class="text-dark mb-4 fw-semibold">
            <i class="feather-map me-2"></i>Tahapan Proses Pendaftaran
        </h5>
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="timeline-container">
                    <!-- Step 1 -->
                    <a href="{{ route('student.dashboard', ['step' => 1]) }}" class="timeline-step text-decoration-none text-reset">
                        <div class="timeline-marker step-1">
                            <i class="feather-bell"></i>
                        </div>
                        <div class="timeline-content">
                            <h6 class="text-dark mb-1">Pengumuman Pendaftaran</h6>
                            <p class="text-muted small mb-0">1 Januari 2026</p>
                        </div>
                    </a>

                    <div class="timeline-connector"></div>

                    <!-- Step 2 -->
                    <a href="{{ route('student.dashboard', ['step' => 2]) }}" class="timeline-step text-decoration-none text-reset">
                        <div class="timeline-marker step-2">
                            <i class="feather-edit"></i>
                        </div>
                        <div class="timeline-content">
                            <h6 class="text-dark mb-1">Pendaftaran</h6>
                            <p class="text-muted small mb-0">1 - 31 Maret 2026</p>
                        </div>
                    </a>

                    <div class="timeline-connector"></div>

                    <!-- Step 3 -->
                    <a href="{{ route('student.dashboard', ['step' => 3]) }}" class="timeline-step text-decoration-none text-reset">
                        <div class="timeline-marker step-3">
                            <i class="feather-check-square"></i>
                        </div>
                        <div class="timeline-content">
                            <h6 class="text-dark mb-1">Seleksi Sesuai Jalur</h6>
                            <p class="text-muted small mb-0">1 - 14 April 2026</p>
                        </div>
                    </a>

                    <div class="timeline-connector"></div>

                    <!-- Step 4 -->
                    <a href="{{ route('student.dashboard', ['step' => 4]) }}" class="timeline-step text-decoration-none text-reset">
                        <div class="timeline-marker step-4">
                            <i class="feather-clipboard"></i>
                        </div>
                        <div class="timeline-content">
                            <h6 class="text-dark mb-1">Daftar Ulang</h6>
                            <p class="text-muted small mb-0">1 - 10 Mei 2026</p>
                        </div>
                    </a>

                    <div class="timeline-connector"></div>

                    <!-- Step 5 -->
                    <a href="{{ route('student.dashboard', ['step' => 5]) }}" class="timeline-step text-decoration-none text-reset">
                        <div class="timeline-marker step-5">
                            <i class="feather-award"></i>
                        </div>
                        <div class="timeline-content">
                            <h6 class="text-dark mb-1">Penetapan Peserta Didik</h6>
                            <p class="text-muted small mb-0">15 Mei 2026</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Info Section -->
<div class="row mt-5">
    <div class="col-lg-12">
        <h5 class="text-dark mb-3 fw-semibold">Informasi Penting</h5>
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <h6 class="text-dark mb-2">
                            <i class="feather-alert-circle text-warning me-2"></i> Persyaratan Pendaftaran
                        </h6>
                        <ul class="small text-muted ps-3">
                            <li>Fotokopi akta kelahiran</li>
                            <li>Fotokopi KTP orang tua</li>
                            <li>Raport 2 tahun terakhir</li>
                            <li>Sertifikat prestasi (jika ada)</li>
                            <li>Surat keterangan sehat</li>
                        </ul>
                    </div>
                    <div class="col-md-6 mb-3">
                        <h6 class="text-dark mb-2">
                            <i class="feather-info text-info me-2"></i> Jadwal Pendaftaran
                        </h6>
                        <ul class="small text-muted ps-3">
                            <li><strong>Pembukaan:</strong> 1 Januari 2026</li>
                            <li><strong>Penutupan:</strong> 31 Maret 2026</li>
                            <li><strong>Pengumuman:</strong> 15 April 2026</li>
                            <li><strong>Daftar Ulang:</strong> 1 - 10 Mei 2026</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .transition-all {
        transition: all 0.3s ease !important;
    }

    .dashboard-feature-card:hover,
    .material-preview-card:hover,
    .dashboard-section-card:hover {
        transform: translateY(-6px) !important;
        box-shadow: 0 14px 32px rgba(0, 0, 0, 0.12) !important;
    }

    .bg-light-primary {
        background-color: rgba(88, 99, 255, 0.1);
    }

    .bg-light-success {
        background-color: rgba(5, 173, 99, 0.1);
    }

    .bg-light-info {
        background-color: rgba(0, 191, 243, 0.1);
    }

    .bg-light-warning {
        background-color: rgba(255, 193, 7, 0.15);
    }

    .welcome-icon-wrap {
        width: 72px;
        height: 72px;
        border-radius: 50%;
        background: rgba(88, 99, 255, 0.08);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* Timeline Styling */
    .timeline-container {
        display: flex;
        align-items: flex-start;
        gap: 24px;
        overflow-x: auto;
        padding: 20px 0;
    }

    .timeline-step {
        display: flex;
        align-items: flex-start;
        gap: 16px;
        min-width: 200px;
        padding: 12px;
        border-radius: 10px;
        transition: all 0.3s ease;
    }

    .timeline-step:hover {
        background-color: rgba(88, 99, 255, 0.05);
        transform: translateY(-2px);
    }

    .timeline-marker {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 20px;
        flex-shrink: 0;
        transition: all 0.3s ease;
    }

    .step-1 { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }
    .step-2 { background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); }
    .step-3 { background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); }
    .step-4 { background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%); }
    .step-5 { background: linear-gradient(135deg, #fa709a 0%, #fee140 100%); }

    .timeline-step:hover .timeline-marker {
        transform: scale(1.08);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    }

    .timeline-content {
        flex: 1;
    }

    .timeline-connector {
        flex: 1;
        height: 2px;
        background: linear-gradient(90deg, #667eea, #764ba2, #f093fb, #4facfe, #43e97b);
        min-width: 24px;
        margin-top: 24px;
    }

    @media (max-width: 768px) {
        .timeline-container {
            flex-direction: column;
            gap: 12px;
        }

        .timeline-connector {
            width: 2px;
            height: 24px;
            margin-left: 24px;
            margin-top: 0;
        }
    }
</style>

<script>
    const stepDetails = {
        1: {
            title: '📢 Pengumuman Pendaftaran',
            date: '1 Januari 2026',
            description: 'Sekolah mengumumkan pembukaan pendaftaran siswa baru tahun ajaran berikutnya.',
            content: `
                <div class="row">
                    <div class="col-md-6">
                        <h6 class="text-dark mb-2">Apa yang perlu dilakukan:</h6>
                        <ul class="small text-muted ps-3">
                            <li>Persiapkan dokumen pendaftaran</li>
                            <li>Cari informasi tentang jalur pendaftaran</li>
                            <li>Mendiskusikan dengan orang tua/wali</li>
                            <li>Cek syarat dan ketentuan pendaftaran</li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <div class="alert alert-info mb-0">
                            <strong>💡 Tips:</strong> Siapkan semua dokumen yang diperlukan sejak awal agar proses pendaftaran lancar.
                        </div>
                    </div>
                </div>
            `
        },
        2: {
            title: '✏️ Periode Pendaftaran',
            date: '1 - 31 Maret 2026',
            description: 'Periode terbuka untuk mendaftarkan diri sesuai dengan jalur pendaftaran yang dipilih.',
            content: `
                <div class="row">
                    <div class="col-md-6">
                        <h6 class="text-dark mb-2">Langkah pendaftaran:</h6>
                        <ul class="small text-muted ps-3">
                            <li>Isi formulir pendaftaran dengan lengkap dan jujur</li>
                            <li>Upload dokumen persyaratan</li>
                            <li>Bayar biaya pendaftaran (jika ada)</li>
                            <li>Simpan nomor registrasi Anda</li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <div class="alert alert-warning mb-0">
                            <strong>⏰ Catatan:</strong> Pastikan formulir disubmit sebelum tanggal penutupan 31 Maret 2026.
                        </div>
                    </div>
                </div>
            `
        },
        3: {
            title: '✔️ Seleksi Sesuai Jalur Pendaftaran',
            date: '1 - 14 April 2026',
            description: 'Proses seleksi dilakukan sesuai dengan jalur pendaftaran yang telah dipilih.',
            content: `
                <div class="row">
                    <div class="col-md-6">
                        <h6 class="text-dark mb-2">Jalur pendaftaran:</h6>
                        <ul class="small text-muted ps-3">
                            <li><strong>Jalur Prestasi:</strong> Berdasarkan nilai akademik dan sertifikat</li>
                            <li><strong>Jalur Umum:</strong> Berdasarkan nilai rata-rata rapor</li>
                            <li><strong>Jalur Khusus:</strong> Untuk anak-anak guru/karyawan</li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <div class="alert alert-info mb-0">
                            <strong>ℹ️ Informasi:</strong> Tim seleksi akan memverifikasi semua dokumen yang Anda upload.
                        </div>
                    </div>
                </div>
            `
        },
        4: {
            title: '📋 Daftar Ulang',
            date: '1 - 10 Mei 2026',
            description: 'Calon peserta didik yang diterima melakukan pendaftaran ulang untuk finalisasi data.',
            content: `
                <div class="row">
                    <div class="col-md-6">
                        <h6 class="text-dark mb-2">Yang harus diperhatikan:</h6>
                        <ul class="small text-muted ps-3">
                            <li>Cek pengumuman diterima terlebih dahulu</li>
                            <li>Datang tepat waktu sesuai jadwal</li>
                            <li>Bawa dokumen asli & fotokopi</li>
                            <li>Bayar biaya pendaftaran ulang</li>
                            <li>Melunasi biaya SPP (jika ada)</li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <div class="alert alert-success mb-0">
                            <strong>✅ Syarat:</strong> Daftar ulang harus diselesaikan untuk mengonfirmasi penerimaan Anda.
                        </div>
                    </div>
                </div>
            `
        },
        5: {
            title: '🎓 Penetapan Peserta Didik Baru',
            date: '15 Mei 2026',
            description: 'Pengumuman resmi peserta didik baru yang telah diterima dan menyelesaikan all proses.',
            content: `
                <div class="row">
                    <div class="col-md-6">
                        <h6 class="text-dark mb-2">Tahapan selanjutnya:</h6>
                        <ul class="small text-muted ps-3">
                            <li>Menerima surat kelulusan resmi</li>
                            <li>Pembagian jadwal kelas</li>
                            <li>Pembagian kelompok belajar</li>
                            <li>Memulai pembelajaran tahun ajaran baru</li>
                            <li>Ikuti acara orientasi siswa baru</li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <div class="alert alert-success mb-0">
                            <strong>🎉 Selamat!</strong> Anda telah resmi menjadi peserta didik di sekolah kami.
                        </div>
                    </div>
                </div>
            `
        }
    };

    function showStepDetail(step) {
        const detail = stepDetails[step];
        const stepDetail = document.getElementById('stepDetail');
        const stepTitle = document.getElementById('stepTitle');
        const stepDescription = document.getElementById('stepDescription');
        const stepContent = document.getElementById('stepContent');

        if (!stepDetail || !stepTitle || !stepDescription || !stepContent) return;

        stepTitle.textContent = detail.title;
        stepDescription.textContent = detail.date;
        stepContent.innerHTML = detail.content;

        stepDetail.style.display = 'block';
        stepDetail.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    }

    function hideStepDetail() {
        const stepDetail = document.getElementById('stepDetail');
        if (stepDetail) {
            stepDetail.style.display = 'none';
        }
    }
</script>