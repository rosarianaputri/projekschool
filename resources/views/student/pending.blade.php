@extends('layouts.student')

@php
    $title = 'Menunggu Persetujuan Admin';
@endphp

@section('content')
<div class="nxl-content-right">
    <div class="nxl-content-inner" style="padding-top: 60px; padding-left: 40px; padding-right: 40px; padding-bottom: 40px;">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm">
                    <div class="card-body text-center py-5">
                        @php
                            $status = strtolower((string) ($user->status ?? 'pending'));
                        @endphp

                        <div class="mb-4">
                            @if($status === 'rejected')
                                <div class="avatar-text rounded-circle bg-light-danger d-inline-flex align-items-center justify-content-center"
                                     style="width: 80px; height: 80px;">
                                    <i class="feather-x-circle fs-30 text-danger"></i>
                                </div>
                            @else
                                <div class="avatar-text rounded-circle bg-light-warning d-inline-flex align-items-center justify-content-center"
                                     style="width: 80px; height: 80px;">
                                    <i class="feather-clock fs-30 text-warning"></i>
                                </div>
                            @endif
                        </div>

                        @if($status === 'rejected')
                            <h3 class="mb-2">Akun Anda Ditolak</h3>
                            <p class="text-muted mb-4">
                                Maaf, akun siswa Anda belum disetujui oleh admin. Silakan hubungi pihak sekolah untuk informasi lebih lanjut.
                            </p>
                        @else
                            <h3 class="mb-2">Akun Menunggu Persetujuan</h3>
                            <p class="text-muted mb-4">
                                Akun siswa Anda sudah berhasil dibuat, tetapi belum dapat mengakses seluruh fitur.
                                Silakan tunggu sampai admin menyetujui akun Anda.
                            </p>
                        @endif

                        <div class="d-flex justify-content-center gap-2 flex-wrap">
                            <a href="{{ route('profile.edit') }}" class="btn btn-outline-primary">
                                Lihat Profil
                            </a>

                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-light border">
                                    Keluar
                                </button>
                            </form>
                        </div>

                        <div class="mt-4">
                            <small class="text-muted">
                                Status akun saat ini:
                                @if($status === 'approved')
                                    <span class="badge bg-success">Approved</span>
                                @elseif($status === 'rejected')
                                    <span class="badge bg-danger">Rejected</span>
                                @else
                                    <span class="badge bg-warning text-dark">Pending</span>
                                @endif
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .bg-light-warning {
        background-color: rgba(255, 193, 7, 0.15);
    }

    .bg-light-danger {
        background-color: rgba(220, 53, 69, 0.12);
    }
</style>
@endsection