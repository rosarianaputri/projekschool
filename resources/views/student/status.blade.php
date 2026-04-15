    @extends('layouts.student')

@section('content')

<div class="nxl-content-right">
    <div class="nxl-content-inner" style="padding-top: 30px; padding-left: 30px; padding-right: 30px;">
        <!-- Page Header -->
        <div class="nxl-head mb-4">
            <div class="nxl-head-content">
                <h2 class="nxl-title mb-1">
                    <i class="feather-clock me-2"></i>Status Pendaftaran Anda
                </h2>
                <p class="nxl-head-text">Pantau status aplikasi pendaftaran Anda secara real-time</p>
            </div>
        </div>

        @if($application)
            <!-- Status Badge -->
            <div class="row mb-4">
                <div class="col-lg-12">
                    <div class="card border-0">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between">
                                <div>
                                    <h6 class="text-muted mb-2">Status Verifikasi</h6>
                                    <div>
                                        @if($application->status === 'pending')
                                            <span class="badge bg-warning fs-12">
                                                <i class="feather-hourglass me-1"></i> Menunggu Verifikasi
                                            </span>
                                        @elseif($application->status === 'approved')
                                            <span class="badge bg-success fs-12">
                                                <i class="feather-check-circle me-1"></i> Diterima
                                            </span>
                                        @elseif($application->status === 'rejected')
                                            <span class="badge bg-danger fs-12">
                                                <i class="feather-x-circle me-1"></i> Ditolak
                                            </span>
                                        @else
                                            <span class="badge bg-secondary fs-12">
                                                <i class="feather-help-circle me-1"></i> Status Tidak Diketahui
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="text-end">
                                    <p class="text-muted small mb-1">Tanggal Pendaftaran</p>
                                    <h6 class="text-dark">
                                        {{ $application->birth_date ? \Carbon\Carbon::parse($application->birth_date)->format('d M Y') : '-' }}
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Status Messages -->
            @if($application->status === 'approved')
                <div class="row mb-4">
                    <div class="col-lg-12">
                        <div class="alert alert-success border-0 bg-light-success" role="alert">
                            <div class="d-flex">
                                <div class="flex-shrink-0">
                                    <i class="feather-check-circle fs-20 text-success"></i>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="alert-heading text-success mb-1">Selamat! 🎉</h6>
                                    <p class="mb-0 text-muted small">Anda telah diterima sebagai siswa baru. Silakan hubungi bagian administrasi sekolah untuk melanjutkan proses daftar ulang.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @elseif($application->status === 'rejected')
                <div class="row mb-4">
                    <div class="col-lg-12">
                        <div class="alert alert-danger border-0 bg-light-danger" role="alert">
                            <div class="d-flex">
                                <div class="flex-shrink-0">
                                    <i class="feather-alert-triangle fs-20 text-danger"></i>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="alert-heading text-danger mb-1">Mohon Maaf</h6>
                                    <p class="mb-0 text-muted small">Aplikasi Anda belum diterima kali ini. Anda dapat mendaftar kembali pada periode pendaftaran tahun depan.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="row mb-4">
                    <div class="col-lg-12">
                        <div class="alert alert-info border-0 bg-light-info" role="alert">
                            <div class="d-flex">
                                <div class="flex-shrink-0">
                                    <i class="feather-info fs-20 text-info"></i>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="alert-heading text-info mb-1">Sedang Diproses</h6>
                                    <p class="mb-0 text-muted small">Aplikasi Anda sedang kami verifikasi. Status akan segera diperbarui, mohon ditunggu.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Application Details -->
            <div class="row">
                <div class="col-lg-8">
                    <div class="card border-0">
                        <div class="card-header bg-light border-0">
                            <h6 class="mb-0 text-dark">
                                <i class="feather-user me-2"></i>Data Pendaftaran
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <p class="text-muted small mb-1">Nama Lengkap</p>
                                    <h6 class="text-dark">{{ $application->student_name ?? auth()->user()->name }}</h6>
                                </div>
                                <div class="col-md-6">
                                    <p class="text-muted small mb-1">Jenis Kelamin</p>
                                    <h6 class="text-dark">{{ $application->gender === 'L' ? 'Laki-laki' : 'Perempuan' }}</h6>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <p class="text-muted small mb-1">Tempat Lahir</p>
                                    <h6 class="text-dark">{{ $application->birth_place ?? '-' }}</h6>
                                </div>
                                <div class="col-md-6">
                                    <p class="text-muted small mb-1">Tanggal Lahir</p>
                                    <h6 class="text-dark">{{ $application->birth_date ? $application->birth_date->format('d M Y') : '-' }}</h6>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <p class="text-muted small mb-1">Email</p>
                                    <h6 class="text-dark">{{ $application->email ?? auth()->user()->email }}</h6>
                                </div>
                                <div class="col-md-6">
                                    <p class="text-muted small mb-1">Nomor Ponsel</p>
                                    <h6 class="text-dark">{{ $application->phone ?? '-' }}</h6>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <p class="text-muted small mb-1">Sekolah Asal</p>
                                    <h6 class="text-dark">{{ $application->previous_school ?? '-' }}</h6>
                                </div>
                                <div class="col-md-6">
                                    <p class="text-muted small mb-1">Nama Orang Tua/Wali</p>
                                    <h6 class="text-dark">{{ $application->parent_name ?? '-' }}</h6>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <p class="text-muted small mb-1">Alamat</p>
                                    <h6 class="text-dark">{{ $application->address ?? '-' }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                <div class="col-lg-4">
                    <div class="card border-0">
                        <div class="card-header bg-light border-0">
                            <h6 class="mb-0 text-dark">
                                <i class="feather-arrow-right me-2"></i>Langkah Berikutnya
                            </h6>
                        </div>
                        <div class="card-body">
                            @if($application->status === 'approved')
                                <p class="small text-muted mb-3">Silakan hubungi bagian administrasi untuk:</p>
                                <ul class="list-unstyled small text-muted">
                                    <li class="mb-2">
                                        <i class="feather-check text-success me-2"></i>
                                        Mengisi formulir daftar ulang
                                    </li>
                                    <li class="mb-2">
                                        <i class="feather-check text-success me-2"></i>
                                        Pembayaran biaya pendaftaran
                                    </li>
                                    <li>
                                        <i class="feather-check text-success me-2"></i>
                                        Mendapatkan informasi tingkat kelas
                                    </li>
                                </ul>
                            @elseif($application->status === 'rejected')
                                <p class="small text-muted">Jika Anda ingin mendaftar kembali, silakan menunggu periode pendaftaran berikutnya.</p>
                            @else
                                <p class="small text-muted mb-3">Sementara itu, Anda dapat:</p>
                                <ul class="list-unstyled small text-muted">
                                    <li class="mb-2">
                                        <i class="feather-arrow-right me-2"></i>
                                        Memastikan semua berkas lengkap
                                    </li>
                                    <li class="mb-2">
                                        <i class="feather-arrow-right me-2"></i>
                                        Mengecek status kembali nanti
                                    </li>
                                    <li>
                                        <i class="feather-arrow-right me-2"></i>
                                        Hubungi admin jika ada pertanyaan
                                    </li>
                                </ul>
                            @endif
                        </div>
                    </div>

                    <!-- Contact Card -->
                    <div class="card border-0 mt-3">
                        <div class="card-body text-center">
                            <i class="feather-phone fs-30 text-primary mb-2 d-block"></i>
                            <h6 class="text-dark mb-2">Butuh Bantuan?</h6>
                            <p class="small text-muted mb-0">Hubungi bagian administrasi sekolah untuk informasi lebih lanjut.</p>
                        </div>
                    </div>
                </div>
            </div>

        @else
            <!-- No Application State -->
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <div class="card border-0 text-center py-5">
                        <div class="card-body">
                            <i class="feather-inbox fs-60 text-muted mb-3 d-block"></i>
                            <h5 class="text-dark mb-2">Belum Ada Pendaftaran</h5>
                            <p class="text-muted mb-4">Anda belum melakukan pendaftaran. Silakan isi formulir pendaftaran terlebih dahulu untuk memulai proses registrasi.</p>
                            <a href="{{ route('student.formulir') }}" class="btn btn-primary">
                                <i class="feather-file me-2"></i>Isi Formulir Pendaftaran
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- Back Button -->
        <div class="mt-4">
            <a href="{{ route('student.dashboard') }}" class="btn btn-secondary">
                <i class="feather-arrow-left me-2"></i>Kembali ke Dashboard
            </a>
        </div>
    </div>
</div>

<style>
    .bg-light-success {
        background-color: rgba(5, 173, 99, 0.1);
    }
    
    .bg-light-danger {
        background-color: rgba(220, 53, 69, 0.1);
    }
    
    .bg-light-info {
        background-color: rgba(0, 191, 243, 0.1);
    }
</style>

@endsection
