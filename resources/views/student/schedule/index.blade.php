@extends('layouts.student')

@php
    $title = 'Dashboard Siswa - Jadwal';
@endphp

@section('content')
<div class="nxl-content-right">
    <div class="nxl-content-inner" style="padding-top: 60px; padding-left: 40px; padding-right: 40px; padding-bottom: 40px;">

        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body">
                <div class="d-flex flex-column flex-lg-row align-items-start align-items-lg-center justify-content-between gap-3">
                    <div>
                        <h3 class="mb-1">Jadwal Pembelajaran</h3>
                        <p class="text-muted mb-0">
                            @if($studentClass && $studentClass->class)
                                Jadwal untuk kelas {{ $studentClass->class->name }} - {{ $studentClass->class->subject }}
                            @else
                                Lihat jadwal belajar sesuai kelas Anda.
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
                    @if($schedules->isEmpty())
                        <div class="text-center py-5">
                            <div class="avatar-text rounded-circle bg-light-warning d-inline-flex align-items-center justify-content-center mb-3 mx-auto"
                                 style="width: 64px; height: 64px;">
                                <i class="feather-calendar fs-24 text-warning"></i>
                            </div>
                            <h5 class="mb-2">Belum Ada Jadwal</h5>
                            <p class="text-muted mb-0">Jadwal kelas akan tampil di halaman ini setelah diatur admin.</p>
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th class="ps-3">Hari</th>
                                        <th>Waktu</th>
                                        <th>Kelas</th>
                                        <th>Guru</th>
                                        <th class="pe-3">Ruang</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($schedules as $schedule)
                                        <tr>
                                            <td class="ps-3">
                                                <div class="fw-semibold">{{ $schedule->day }}</div>
                                            </td>
                                            <td>
                                                <span class="badge bg-soft-info text-info">
                                                    {{ $schedule->start_time }} - {{ $schedule->end_time }}
                                                </span>
                                            </td>
                                            <td>{{ $schedule->class->name ?? '-' }}</td>
                                            <td>{{ $schedule->class->teacher->name ?? '-' }}</td>
                                            <td class="pe-3">{{ $schedule->room ?: '-' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-4 d-flex justify-content-center">
                            {{ $schedules->links() }}
                        </div>
                    @endif
                </div>
            </div>
        @endif

    </div>
</div>

<style>
    .bg-light-warning {
        background-color: rgba(255, 193, 7, 0.15);
    }
</style>
@endsection