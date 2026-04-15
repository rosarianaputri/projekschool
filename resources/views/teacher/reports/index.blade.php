@extends('layouts.admin')

@php
    $title = 'LaylaSchool || Laporan Guru';
    $pageTitle = 'Laporan';
@endphp

@section('content')
<div class="row g-4">

    <div class="col-12">
        <div class="card stretch stretch-full">
            <div class="card-body">
                <div class="d-flex flex-column flex-lg-row align-items-start align-items-lg-center justify-content-between gap-3">
                    <div>
                        <h3 class="mb-1">Ringkasan & Laporan Guru</h3>
                        <p class="text-muted mb-0">Pantau statistik kelas, siswa, tugas, materi, nilai, dan absensi dalam tampilan yang lebih rapi.</p>
                    </div>
                    <div class="d-flex flex-wrap gap-2">
                        <span class="badge bg-info text-dark">Statistik Kelas</span>
                        <span class="badge bg-success">Monitoring Siswa</span>
                        <span class="badge bg-warning text-dark">Evaluasi Cepat</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-2 col-md-4 col-sm-6">
        <div class="card stretch stretch-full">
            <div class="card-body">
                <span class="text-muted d-block mb-2">Kelas</span>
                <h2 class="fw-bold mb-1">{{ $summary['classes'] }}</h2>
                <p class="text-muted small mb-0">Jumlah kelas yang dikelola</p>
            </div>
        </div>
    </div>

    <div class="col-xl-2 col-md-4 col-sm-6">
        <div class="card stretch stretch-full">
            <div class="card-body">
                <span class="text-muted d-block mb-2">Siswa</span>
                <h2 class="fw-bold mb-1">{{ $summary['students'] }}</h2>
                <p class="text-muted small mb-0">Total siswa terdaftar</p>
            </div>
        </div>
    </div>

    <div class="col-xl-2 col-md-4 col-sm-6">
        <div class="card stretch stretch-full">
            <div class="card-body">
                <span class="text-muted d-block mb-2">Tugas</span>
                <h2 class="fw-bold mb-1">{{ $summary['assignments'] }}</h2>
                <p class="text-muted small mb-0">Total tugas tersedia</p>
            </div>
        </div>
    </div>

    <div class="col-xl-2 col-md-4 col-sm-6">
        <div class="card stretch stretch-full">
            <div class="card-body">
                <span class="text-muted d-block mb-2">Materi</span>
                <h2 class="fw-bold mb-1">{{ $summary['materials'] }}</h2>
                <p class="text-muted small mb-0">Materi yang sudah dibuat</p>
            </div>
        </div>
    </div>

    <div class="col-xl-2 col-md-4 col-sm-6">
        <div class="card stretch stretch-full border-warning">
            <div class="card-body">
                <span class="text-muted d-block mb-2">Nilai</span>
                <h2 class="fw-bold mb-1">{{ $summary['grades'] }}</h2>
                <p class="text-muted small mb-0">Catatan nilai tersimpan</p>
            </div>
        </div>
    </div>

    <div class="col-xl-2 col-md-4 col-sm-6">
        <div class="card stretch stretch-full border-danger">
            <div class="card-body">
                <span class="text-muted d-block mb-2">Absensi</span>
                <h2 class="fw-bold mb-1">{{ $summary['attendance_records'] }}</h2>
                <p class="text-muted small mb-0">Rekap absensi tercatat</p>
            </div>
        </div>
    </div>

    <div class="col-12">
        <div class="card stretch stretch-full">
            <div class="card-header">
                <div>
                    <h5 class="card-title mb-0">Kelas Teratas</h5>
                    <small class="text-muted">Ringkasan kelas aktif yang paling menonjol</small>
                </div>
            </div>
            <div class="card-body">
                @if($topClasses->isEmpty())
                    <div class="text-center py-5">
                        <div class="mb-3">
                            <span class="avatar-text avatar-lg rounded-circle bg-light text-primary">
                                <i class="fas fa-chart-bar"></i>
                            </span>
                        </div>
                        <h5 class="mb-2">Belum ada data kelas</h5>
                        <p class="text-muted mb-0">Tambahkan kelas terlebih dahulu agar statistik tampil di halaman ini.</p>
                    </div>
                @else
                    <div class="row g-3">
                        @foreach($topClasses as $class)
                            <div class="col-xl-4 col-md-6">
                                <div class="border rounded-3 p-3 h-100">
                                    <div class="d-flex align-items-start justify-content-between mb-2">
                                        <div>
                                            <h6 class="mb-1">{{ $class->name }}</h6>
                                            <p class="text-muted small mb-0">{{ $class->subject ?: 'Mata pelajaran belum diisi' }}</p>
                                        </div>
                                        <span class="badge bg-primary">Aktif</span>
                                    </div>

                                    <div class="mt-3">
                                        <div class="small text-muted mb-1">Jadwal</div>
                                        <div class="fw-semibold">
                                            {{ $class->schedule ?: 'Jadwal belum diisi' }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection