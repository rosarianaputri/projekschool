@extends('layouts.admin')

@php
    $title = 'LaylaSchool || Jadwal Guru';
    $pageTitle = 'Jadwal';
@endphp

@section('content')
<div class="row g-4">

    <div class="col-12">
        <div class="card stretch stretch-full">
            <div class="card-body">
                <div class="d-flex flex-column flex-lg-row align-items-start align-items-lg-center justify-content-between gap-3">
                    <div>
                        <h3 class="mb-1">Jadwal Mengajar</h3>
                        <p class="text-muted mb-0">Atur sesi belajar agar kelas, waktu, dan ruangan tersusun lebih jelas.</p>
                    </div>
                    <a href="{{ route('teacher.schedule.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus me-1"></i> Tambah Jadwal
                    </a>
                </div>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="col-12">
            <div class="alert alert-success border-0 shadow-sm mb-0">
                {{ session('success') }}
            </div>
        </div>
    @endif

    <div class="col-12">
        <div class="card stretch stretch-full">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="card-title mb-0">Daftar Jadwal</h5>
                    <small class="text-muted">Total: {{ $schedules->total() }} jadwal</small>
                </div>
            </div>

            <div class="card-body">
                @if($schedules->isEmpty())
                    <div class="text-center py-5">
                        <div class="mb-3">
                            <span class="avatar-text avatar-lg rounded-circle bg-light text-primary">
                                <i class="fas fa-calendar-alt"></i>
                            </span>
                        </div>
                        <h5 class="mb-2">Belum ada jadwal</h5>
                        <p class="text-muted mb-3">Tambahkan jadwal pelajaran agar aktivitas mengajar lebih terorganisir.</p>
                        <a href="{{ route('teacher.schedule.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus me-1"></i> Tambah Jadwal
                        </a>
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="ps-3">Hari</th>
                                    <th>Waktu</th>
                                    <th>Kelas</th>
                                    <th>Ruang</th>
                                    <th class="text-end pe-3">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($schedules as $schedule)
                                    <tr>
                                        <td class="ps-3">
                                            <div class="fw-semibold">{{ $schedule->day }}</div>
                                            <small class="text-muted">Sesi pembelajaran</small>
                                        </td>
                                        <td>
                                            <span class="badge bg-soft-info text-info">
                                                {{ $schedule->start_time }} - {{ $schedule->end_time }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge bg-soft-primary text-primary">
                                                {{ $schedule->class->name ?? '-' }}
                                            </span>
                                        </td>
                                        <td>
                                            @if($schedule->room)
                                                <span class="badge bg-light text-dark border">{{ $schedule->room }}</span>
                                            @else
                                                <span class="text-muted">Belum diisi</span>
                                            @endif
                                        </td>
                                        <td class="text-end pe-3">
                                            <div class="d-inline-flex gap-2">
                                                <a href="{{ route('teacher.schedule.edit', $schedule) }}" class="btn btn-sm btn-outline-primary">
                                                    Edit
                                                </a>
                                                <form action="{{ route('teacher.schedule.destroy', $schedule) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Hapus jadwal ini?')">
                                                        Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-center mt-4">
                        {{ $schedules->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection