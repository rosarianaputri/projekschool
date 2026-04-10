<!-- Page Header -->
<div class="nxl-head mb-5">
    <div class="nxl-head-content">
        <h2 class="nxl-title mb-2">Selamat Datang, {{ auth()->user()->name }}!</h2>
        <p class="nxl-head-text">Kelola pendaftaran dan berkas Anda di sini</p>
    </div>
</div>

<!-- Welcome Card -->
<div class="row mb-4">
    <div class="col-lg-12">
        <div class="card border-0 bg-light-primary">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <h5 class="text-dark mb-2">Halo {{ auth()->user()->name }}! 👋</h5>
                        <p class="text-muted mb-0">Pastikan semua berkas dan formulir Anda sudah lengkap dan sesuai dengan persyaratan.</p>
                    </div>
                    <i class="feather-check-circle fs-50 text-primary opacity-50"></i>
                </div>
            </div>
        </div>
    </div>
</div>

@if (!$application)
    <div class="alert alert-warning mb-4" role="alert">
        <i class="feather-alert-circle me-2"></i>
        Data pendaftaran belum ada. Silakan isi formulir pendaftaran terlebih dahulu.
    </div>
@elseif ($documentSummary && !$documentSummary['is_complete'])
    <div class="alert alert-info mb-4" role="alert">
        <i class="feather-info me-2"></i>
        Berkas belum lengkap: {{ $documentSummary['uploaded_required'] }}/{{ $documentSummary['required_total'] }} dokumen wajib sudah diupload.
    </div>
@else
    <div class="alert alert-success mb-4" role="alert">
        <i class="feather-check-circle me-2"></i>
        Berkas persyaratan Anda sudah lengkap.
    </div>
@endif

<!-- Main Dashboard Cards -->
<div class="row">
    <!-- Formulir Pendaftaran -->
    <div class="col-lg-4 col-md-6 mb-4">
        <a href="{{ route('student.formulir') }}" class="card card-body border-0 shadow-sm h-100 transition-all" style="text-decoration: none; cursor: pointer;">
            <div class="text-center">
                <div class="avatar-text rounded-circle bg-light-primary d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                    <i class="feather-file-text fs-24 text-primary"></i>
                </div>
                <h5 class="text-dark mb-2">Formulir Pendaftaran</h5>
                <p class="text-muted small mb-0">Isi formulir pendaftaran siswa baru untuk memulai proses registrasi.</p>
                <div class="mt-3">
                    @if ($application)
                        <span class="badge bg-success">Formulir Sudah Diisi</span>
                    @else
                        <span class="badge bg-primary">Buka Formulir →</span>
                    @endif
                </div>
            </div>
        </a>
    </div>

    <!-- Upload Berkas -->
    <div class="col-lg-4 col-md-6 mb-4">
        <a href="{{ route('student.upload') }}" class="card card-body border-0 shadow-sm h-100 transition-all" style="text-decoration: none; cursor: pointer;">
            <div class="text-center">
                <div class="avatar-text rounded-circle bg-light-success d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                    <i class="feather-upload-cloud fs-24 text-success"></i>
                </div>
                <h5 class="text-dark mb-2">Upload Berkas</h5>
                <p class="text-muted small mb-0">Unggah dokumen persyaratan yang diperlukan untuk melengkapi pendaftaran Anda.</p>
                <div class="mt-3">
                    @if ($documentSummary && $documentSummary['is_complete'])
                        <span class="badge bg-success">Berkas Lengkap</span>
                    @elseif ($documentSummary)
                        <span class="badge bg-warning text-dark">{{ $documentSummary['uploaded_required'] }}/{{ $documentSummary['required_total'] }} Wajib</span>
                    @else
                        <span class="badge bg-secondary">Isi Formulir Dulu</span>
                    @endif
                </div>
            </div>
        </a>
    </div>

    <!-- Status Pendaftaran -->
    <div class="col-lg-4 col-md-6 mb-4">
        <a href="{{ route('student.status') }}" class="card card-body border-0 shadow-sm h-100 transition-all" style="text-decoration: none; cursor: pointer;">
            <div class="text-center">
                <div class="avatar-text rounded-circle bg-light-info d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                    <i class="feather-clock fs-24 text-info"></i>
                </div>
                <h5 class="text-dark mb-2">Status Pendaftaran</h5>
                <p class="text-muted small mb-0">Periksa status verifikasi dan hasil seleksi aplikasi pendaftaran Anda.</p>
                <div class="mt-3">
                    <span class="badge bg-info">Cek Status →</span>
                </div>
            </div>
        </a>
    </div>
</div>

<!-- Tahapan PPDB Section -->
<div class="row mt-5 mb-5">
    <div class="col-lg-12">
        <h5 class="text-dark mb-4">
            <i class="feather-map me-2"></i>Tahapan Proses Pendaftaran
        </h5>
        <div class="card border-0">
            <div class="card-body">
                <div class="timeline-container">
                    <!-- Step 1 -->
                    <a href="{{ route('student.dashboard', ['step' => 1]) }}" class="timeline-step" style="cursor: pointer; text-decoration: none; color: inherit;">
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
                    <a href="{{ route('student.dashboard', ['step' => 2]) }}" class="timeline-step" style="cursor: pointer; text-decoration: none; color: inherit;">
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
                    <a href="{{ route('student.dashboard', ['step' => 3]) }}" class="timeline-step" style="cursor: pointer; text-decoration: none; color: inherit;">
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
                    <a href="{{ route('student.dashboard', ['step' => 4]) }}" class="timeline-step" style="cursor: pointer; text-decoration: none; color: inherit;">
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
                    <a href="{{ route('student.dashboard', ['step' => 5]) }}" class="timeline-step" style="cursor: pointer; text-decoration: none; color: inherit;">
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
        <h5 class="text-dark mb-3">Informasi Penting</h5>
        <div class="card border-0">
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
                            <li><strong>Daftar Ulang:</strong> 1-10 Mei 2026</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .transition-all {
        transition: all 0.3s ease!important;
    }
    
    .card:hover {
        transform: translateY(-5px)!important;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15)!important;
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
        border-radius: 8px;
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
        transform: scale(1.1);
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

        stepTitle.textContent = detail.title;
        stepDescription.textContent = detail.date;
        stepContent.innerHTML = detail.content;
        
        stepDetail.style.display = 'block';
        stepDetail.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    }

    function hideStepDetail() {
        const stepDetail = document.getElementById('stepDetail');
        stepDetail.style.display = 'none';
    }
</script>
