@php
    $stepData = [
        1 => [
            'title' => '📢 Pengumuman Pendaftaran',
            'date' => '1 Januari 2026',
            'description' => 'Sekolah mengumumkan pembukaan pendaftaran siswa baru tahun ajaran berikutnya.',
            'icon' => 'feather-bell',
            'color' => 'step-1',
            'content' => '<div class="row">
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
                </div>'
        ],
        2 => [
            'title' => '✏️ Periode Pendaftaran',
            'date' => '1 - 31 Maret 2026',
            'description' => 'Periode terbuka untuk mendaftarkan diri sesuai dengan jalur pendaftaran yang dipilih.',
            'icon' => 'feather-edit',
            'color' => 'step-2',
            'content' => '<div class="row">
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
                </div>'
        ],
        3 => [
            'title' => '✔️ Seleksi Sesuai Jalur Pendaftaran',
            'date' => '1 - 14 April 2026',
            'description' => 'Proses seleksi dilakukan sesuai dengan jalur pendaftaran yang telah dipilih.',
            'icon' => 'feather-check-square',
            'color' => 'step-3',
            'content' => '<div class="row">
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
                </div>'
        ],
        4 => [
            'title' => '📋 Daftar Ulang',
            'date' => '1 - 10 Mei 2026',
            'description' => 'Calon peserta didik yang diterima melakukan pendaftaran ulang untuk finalisasi data.',
            'icon' => 'feather-clipboard',
            'color' => 'step-4',
            'content' => '<div class="row">
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
                </div>'
        ],
        5 => [
            'title' => '🎓 Penetapan Peserta Didik Baru',
            'date' => '15 Mei 2026',
            'description' => 'Pengumuman resmi peserta didik baru yang telah diterima dan menyelesaikan semua proses.',
            'icon' => 'feather-award',
            'color' => 'step-5',
            'content' => '<div class="row">
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
                </div>'
        ]
    ];
    
    $currentStep = $stepData[$step] ?? null;
@endphp

@if($currentStep)
    <div class="row mb-4">
        <div class="col-lg-12">
            <div class="card border-0">
                <div class="card-body">
                    <div class="step-header mb-4">
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <div class="timeline-marker {{ $currentStep['color'] }}" style="width: 60px; height: 60px;">
                                <i class="{{ $currentStep['icon'] }}"></i>
                            </div>
                            <div>
                                <h3 class="text-dark mb-1">{{ $currentStep['title'] }}</h3>
                                <p class="text-muted mb-0"><i class="feather-calendar me-2"></i>{{ $currentStep['date'] }}</p>
                            </div>
                        </div>
                        <p class="text-muted lead mb-0">{{ $currentStep['description'] }}</p>
                    </div>

                    <hr class="my-4">

                    <div class="step-content">
                        {!! $currentStep['content'] !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Navigation -->
    <div class="row mt-4">
        <div class="col-lg-12">
            <div class="d-flex justify-content-between">
                <a href="{{ route('student.dashboard') }}" class="btn btn-sm btn-outline-secondary">
                    <i class="feather-arrow-left me-1"></i>Kembali
                </a>
                
                @if($step < 5)
                    <a href="{{ route('student.dashboard', ['step' => $step + 1]) }}" class="btn btn-sm btn-primary">
                        Selanjutnya<i class="feather-arrow-right ms-1"></i>
                    </a>
                @else
                    <div></div>
                @endif
            </div>
        </div>
    </div>
@endif

<style>
    .timeline-marker {
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 28px;
        border-radius: 50%;
    }

    .step-1 { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }
    .step-2 { background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); }
    .step-3 { background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); }
    .step-4 { background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%); }
    .step-5 { background: linear-gradient(135deg, #fa709a 0%, #fee140 100%); }

    .step-header {
        padding-bottom: 20px;
    }

    .step-content ul li {
        margin-bottom: 8px;
        line-height: 1.6;
    }

    .step-content .alert {
        border-left: 4px solid;
    }
</style>
