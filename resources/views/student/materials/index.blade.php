@extends('layouts.student')

@php
    $title = 'Dashboard Siswa - Materi';
@endphp

@section('content')
<div class="nxl-content-right">
    <div class="nxl-content-inner" style="padding-top: 60px; padding-left: 40px; padding-right: 40px; padding-bottom: 40px;">

        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body">
                <div class="d-flex flex-column flex-lg-row align-items-start align-items-lg-center justify-content-between gap-3">
                    <div>
                        <h3 class="mb-1">Materi Pembelajaran</h3>
                        <p class="text-muted mb-0">
                            @if($studentClass && $studentClass->class)
                                Materi untuk kelas {{ $studentClass->class->name }} - {{ $studentClass->class->subject }}
                            @else
                                Lihat materi yang dibagikan guru sesuai kelas Anda.
                            @endif
                        </p>
                    </div>
                    <a href="{{ route('student.dashboard') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left me-1"></i> Kembali
                    </a>
                </div>
            </div>
        </div>

        @if(!$studentClass)
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center py-5">
                    <div class="avatar-text rounded-circle bg-light-warning d-inline-flex align-items-center justify-content-center mb-3 mx-auto"
                         style="width: 64px; height: 64px;">
                        <i class="feather-alert-circle fs-24 text-warning"></i>
                    </div>
                    <h5 class="mb-2">Anda belum ditempatkan ke kelas</h5>
                    <p class="text-muted mb-0">Silakan tunggu admin menempatkan Anda ke kelas terlebih dahulu.</p>
                </div>
            </div>
        @else
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    @if($materials->isEmpty())
                        <div class="text-center py-5">
                            <div class="avatar-text rounded-circle bg-light-warning d-inline-flex align-items-center justify-content-center mb-3 mx-auto"
                                 style="width: 64px; height: 64px;">
                                <i class="feather-book-open fs-24 text-warning"></i>
                            </div>
                            <h5 class="mb-2">Belum Ada Materi</h5>
                            <p class="text-muted mb-0">Materi dari guru akan tampil di halaman ini.</p>
                        </div>
                    @else
                        <div class="row g-4">
                            @foreach($materials as $material)
                                <div class="col-lg-4 col-md-6">
                                    <div class="card border-0 shadow-sm h-100 transition-all material-card">
                                        <div class="card-body d-flex flex-column">
                                            <div class="d-flex justify-content-between align-items-start mb-3">
                                                <span class="badge bg-light text-dark border px-3 py-2">
                                                    {{ $material->type ?: 'Materi' }}
                                                </span>
                                                <small class="text-muted">
                                                    {{ $material->created_at ? $material->created_at->format('d M Y') : '-' }}
                                                </small>
                                            </div>

                                            <h5 class="text-dark mb-2 fw-semibold">{{ $material->title }}</h5>

                                            <p class="text-muted small mb-2">
                                                Guru: {{ $material->class->teacher->name ?? '-' }}
                                            </p>

                                            <p class="text-muted small mb-3 flex-grow-1">
                                                {{ \Illuminate\Support\Str::limit($material->notes ?: 'Belum ada deskripsi tambahan untuk materi ini.', 120) }}
                                            </p>

                                            @if($material->link)
                                                <a href="{{ $material->link }}" target="_blank" class="btn btn-primary btn-sm mt-auto">
                                                    <i class="fas fa-external-link-alt me-1"></i> Buka Materi
                                                </a>
                                            @else
                                                <button class="btn btn-light border btn-sm mt-auto" disabled>
                                                    Link belum tersedia
                                                </button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="mt-4 d-flex justify-content-center">
                            {{ $materials->links() }}
                        </div>
                    @endif
                </div>
            </div>
        @endif

    </div>
</div>

<style>
    .transition-all {
        transition: all 0.3s ease !important;
    }

    .material-card:hover {
        transform: translateY(-6px) !important;
        box-shadow: 0 14px 32px rgba(0, 0, 0, 0.12) !important;
    }

    .bg-light-warning {
        background-color: rgba(255, 193, 7, 0.15);
    }
</style>
@endsection