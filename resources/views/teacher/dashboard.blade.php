@extends('layouts.admin')

@php
    $title = 'LaylaSchool || Dashboard Guru';
    $pageTitle = 'Dashboard Guru';
@endphp

@section('content')
<div class="row gy-4">

    {{-- Hero Cockpit --}}
    <div class="col-12">
        <div class="card stretch stretch-full">
            <div class="card-body">
                <div class="d-flex flex-column flex-lg-row align-items-start align-items-lg-center justify-content-between gap-3">
                    <div>
                        <h3 class="mb-2">Halo, {{ auth()->user()->name ?? 'Guru' }} 👋</h3>
                        <p class="text-muted mb-2">Cockpit pengajaran Anda: overview multi-kelas, absensi, nilai, materi, dan tugas - semuanya dalam satu halaman.</p>
                        <div class="d-flex flex-wrap gap-2">
                            <a href="{{ route('teacher.classes.index') }}" class="btn btn-primary btn-sm">Kelola Kelas</a>
                            <a href="{{ route('teacher.attendance.index') }}" class="btn btn-outline-primary btn-sm">Buka Absensi</a>
                            <a href="{{ route('teacher.grades.index') }}" class="btn btn-outline-success btn-sm">Cari Nilai</a>
                        </div>
                    </div>
                    <div class="text-end">
                        <span class="badge bg-info text-dark">Multi-kelas</span>
                        <span class="badge bg-success">Multi-mapel</span>
                        <span class="badge bg-warning text-dark">Lintas semester</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Overview Cards --}}
    <div class="col-xl-2 col-md-4 col-sm-6">
        <div class="card stretch stretch-full">
            <div class="card-body">
                <span class="text-muted d-block mb-2">Kelas Aktif</span>
                <h2 class="fw-bold mb-1">{{ $stats['classes'] }}</h2>
                <p class="text-muted small mb-0">Jumlah kelas yang Anda ampu</p>
            </div>
        </div>
    </div>

    <div class="col-xl-2 col-md-4 col-sm-6">
        <div class="card stretch stretch-full">
            <div class="card-body">
                <span class="text-muted d-block mb-2">Total Siswa</span>
                <h2 class="fw-bold mb-1">{{ $stats['students'] }}</h2>
                <p class="text-muted small mb-0">Seluruh siswa di kelas Anda</p>
            </div>
        </div>
    </div>

    <div class="col-xl-2 col-md-4 col-sm-6">
        <div class="card stretch stretch-full">
            <div class="card-body">
                <span class="text-muted d-block mb-2">Mapel</span>
                <h2 class="fw-bold mb-1">{{ $stats['subjects'] }}</h2>
                <p class="text-muted small mb-0">Mata pelajaran yang Anda ajar</p>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 col-sm-6">
        <div class="card stretch stretch-full border-warning">
            <div class="card-body">
                <span class="text-muted d-block mb-2">Tugas Belum Dinilai</span>
                <h2 class="fw-bold mb-1">{{ $stats['pending_tasks'] }}</h2>
                <p class="text-muted small mb-0">Prioritas penting untuk hari ini</p>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 col-sm-6">
        <div class="card stretch stretch-full border-danger">
            <div class="card-body">
                <span class="text-muted d-block mb-2">Alert Absensi</span>
                <h2 class="fw-bold mb-1">{{ $stats['attendance_alerts'] }}</h2>
                <p class="text-muted small mb-0">Kelas yang belum submit daftar hadir</p>
            </div>
        </div>
    </div>

    {{-- Multi-Class Overview --}}
    <div class="col-12">
        <div class="card stretch stretch-full">
            <div class="card-header d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between gap-3">
                <div>
                    <h5 class="card-title mb-0">Kelas yang Anda Ajar</h5>
                    <small class="text-muted">Semua kelas aktif saat ini di satu tampilan</small>
                </div>
                <a href="{{ route('teacher.classes.index') }}" class="btn btn-outline-primary btn-sm">Lihat Semua Kelas</a>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    @foreach ($classes as $class)
                        <div class="col-xl-3 col-md-6">
                            <div class="border rounded-3 p-3 h-100">
                                <div class="d-flex align-items-start justify-content-between mb-2">
                                    <div>
                                        <h6 class="mb-1">{{ $class['name'] }}</h6>
                                        <p class="text-muted small mb-0">{{ $class['subject'] }}</p>
                                    </div>
                                    <span class="badge bg-primary">{{ $class['students'] }} siswa</span>
                                </div>
                                <p class="text-muted small mb-0">{{ $class['schedule'] }}</p>
                                <div class="mt-3">
                                    <a href="{{ route('teacher.classes.index') }}" class="btn btn-sm btn-secondary">Detail Kelas</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    {{-- Alerts & Quick Notes --}}
    <div class="col-xl-4 col-lg-6">
        <div class="card stretch stretch-full">
            <div class="card-header">
                <h5 class="card-title mb-0">Notifikasi Penting</h5>
            </div>
            <div class="card-body">
                <ul class="list-unstyled mb-0">
                    @foreach ($alerts as $alert)
                        <li class="py-2 border-bottom">{{ $alert }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    <div class="col-xl-4 col-lg-6">
        <div class="card stretch stretch-full">
            <div class="card-header">
                <h5 class="card-title mb-0">Tugas & Materi</h5>
            </div>
            <div class="card-body">
                <div class="d-flex flex-column gap-3">
                    <a href="{{ route('teacher.assignments.index') }}" class="btn btn-outline-primary btn-sm text-start">Buka tugas dan kuis</a>
                    <a href="{{ route('teacher.materials.index') }}" class="btn btn-outline-secondary btn-sm text-start">Upload materi baru</a>
                    <a href="{{ route('teacher.reports.index') }}" class="btn btn-outline-success btn-sm text-start">Lihat laporan siswa</a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-4 col-lg-12">
        <div class="card stretch stretch-full">
            <div class="card-header">
                <h5 class="card-title mb-0">Jadwal Hari Ini</h5>
            </div>
            <div class="card-body">
                <ul class="list-unstyled mb-0">
                    @foreach ($todaySchedule as $item)
                        <li class="py-2 border-bottom">
                            <strong>{{ $item['time'] }}</strong> · {{ $item['title'] }} <br>
                            <small class="text-muted">{{ $item['location'] }}</small>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    {{-- Analitik Ringkas --}}
    <div class="col-lg-6">
        <div class="card stretch stretch-full">
            <div class="card-header">
                <h5 class="card-title mb-0">Ringkasan Nilai</h5>
            </div>
            <div class="card-body">
                <p class="mb-3 text-muted">Fitur input nilai siap untuk setiap kelas, mapel, dan semester.</p>
                <div class="d-flex align-items-center gap-3">
                    <div>
                        <span class="d-block text-muted small">Rata-rata nilai kelas</span>
                        <h4 class="mb-0">78.4%</h4>
                    </div>
                    <div>
                        <span class="d-block text-muted small">Tugas cepat</span>
                        <h4 class="mb-0">15 Masih proses</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card stretch stretch-full">
            <div class="card-header">
                <h5 class="card-title mb-0">Analitik Kehadiran</h5>
            </div>
            <div class="card-body">
                <p class="mb-3 text-muted">Sistem absensi membantu pantau kehadiran kelas per bulan.</p>
                <div class="d-flex align-items-center gap-3">
                    <div>
                        <span class="d-block text-muted small">Hadir</span>
                        <h4 class="mb-0">94%</h4>
                    </div>
                    <div>
                        <span class="d-block text-muted small">Izin / sakit</span>
                        <h4 class="mb-0">23 siswa</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection