@extends('layouts.admin')

@php
    $title = 'Jadwal Kelas';
    $pageTitle = 'Jadwal Kelas';
@endphp

@section('content')
<div class="row g-4">
    <div class="col-12">
        <div class="card stretch stretch-full">
            <div class="card-body">
                <div class="d-flex flex-column flex-lg-row align-items-start align-items-lg-center justify-content-between gap-3">
                    <div>
                        <h3 class="mb-1">Manajemen Jadwal</h3>
                        <p class="text-muted mb-0">Atur jadwal kelas, waktu belajar, dan ruang agar guru dan siswa tinggal mengikuti.</p>
                    </div>
                    <a href="{{ route('admin.schedules.create') }}" class="btn btn-primary">
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
            <div class="card-header">
                <div>
                    <h5 class="card-title mb-0">Daftar Jadwal</h5>
                    <small class="text-muted">Total: {{ $schedules->total() }} jadwal</small>
                </div>
            </div>

            <div class="card-body">
                @if($schedules->isEmpty())
                    <div class="text-center py-5">
                        <h5 class="mb-2">Belum ada jadwal</h5>
                        <p class="text-muted mb-3">Tambahkan jadwal agar guru dan siswa bisa melihat waktu belajar yang sudah ditentukan.</p>
                        <a href="{{ route('schedules.create') }}" class="btn btn-primary">
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
                                    <th>Guru</th>
                                    <th>Ruang</th>
                                    <th class="text-end pe-3">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($schedules as $schedule)
                                    <tr>
                                        <td class="ps-3">
                                            <div class="fw-semibold">{{ $schedule->day }}</div>
                                            <small class="text-muted">Jadwal aktif</small>
                                        </td>
                                        <td>
                                            <span class="badge bg-soft-info text-info">
                                                {{ $schedule->start_time }} - {{ $schedule->end_time }}
                                            </span>
                                        </td>
                                        <td>{{ $schedule->class->name ?? '-' }}</td>
                                        <td>
                                            <span class="badge bg-soft-primary text-primary">
                                                {{ $schedule->class->teacher->name ?? '-' }}
                                            </span>
                                        </td>
                                        <td>{{ $schedule->room ?: '-' }}</td>
                                        <td class="text-end pe-3">
                                            <div class="d-inline-flex gap-2">
                                                <a href="{{ route('admin.schedules.edit', $schedule) }}" class="btn btn-sm btn-outline-primary">
                                                    Edit
                                                </a>
                                                <form action="{{ route('admin.schedules.destroy', $schedule) }}" method="POST" class="d-inline">
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