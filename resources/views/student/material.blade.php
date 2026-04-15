@extends('layouts.student')

@php
    $title = 'Dashboard Siswa - Materi';
@endphp

@section('content')
<div class="nxl-content-right">
    <div class="nxl-content-inner" style="padding-top: 60px; padding-left: 40px; padding-right: 40px; padding-bottom: 40px;">
        <div class="nxl-head mb-4">
            <div class="d-flex flex-column flex-lg-row align-items-start align-items-lg-center justify-content-between gap-3">
                <div>
                    <h2 class="nxl-title mb-2">Materi Pembelajaran</h2>
                    <p class="nxl-head-text mb-0">Lihat materi yang dibagikan guru untuk kelas Anda.</p>
                </div>
                <a href="{{ route('student.dashboard') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left me-1"></i> Kembali ke Dashboard
                </a>
            </div>
        </div>

        <div class="card border-0 shadow-sm">
            <div class="card-body">
                @if($materials->isEmpty())
                    <div class="text-center py-5">
                        <h5 class="mb-2">Belum ada materi</h5>
                        <p class="text-muted mb-0">Materi dari guru akan muncul di halaman ini.</p>
                    </div>
                @else
                    <div class="row g-4">
                        @foreach($materials as $material)
                            <div class="col-lg-4 col-md-6">
                                <div class="card border h-100 shadow-sm">
                                    <div class="card-body d-flex flex-column">
                                        <div class="d-flex justify-content-between align-items-start mb-3">
                                            <span class="badge bg-light text-dark border">
                                                {{ $material->type ?: 'Materi' }}
                                            </span>
                                            <small class="text-muted">{{ $material->created_at->format('d M Y') }}</small>
                                        </div>

                                        <h5 class="mb-2">{{ $material->title }}</h5>
                                        <p class="text-muted small mb-2">Kelas: {{ $material->class->name ?? '-' }}</p>

                                        <p class="text-muted small flex-grow-1">
                                            {{ $material->notes ?: 'Belum ada deskripsi tambahan untuk materi ini.' }}
                                        </p>

                                        @if($material->link)
                                            <a href="{{ $material->link }}" target="_blank" class="btn btn-primary btn-sm mt-2">
                                                <i class="fas fa-external-link-alt me-1"></i> Buka Materi
                                            </a>
                                        @else
                                            <button class="btn btn-light border btn-sm mt-2" disabled>
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
    </div>
</div>
@endsection