@extends('layouts.admin')

@php
    $title = 'LaylaSchool || Tugas Guru';
    $pageTitle = 'Tugas';
@endphp

@section('content')
<div class="row g-4">

    <div class="col-12">
        <div class="card stretch stretch-full">
            <div class="card-body">
                <div class="d-flex flex-column flex-lg-row align-items-start align-items-lg-center justify-content-between gap-3">
                    <div>
                        <h3 class="mb-1">Manajemen Tugas</h3>
                        <p class="text-muted mb-0">Buat, pantau, dan kelola semua tugas siswa dalam satu halaman yang rapi.</p>
                    </div>
                    <div class="d-flex flex-wrap gap-2">
                        <a href="{{ route('teacher.assignments.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus me-1"></i> Tambah Tugas
                        </a>
                    </div>
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
                    <h5 class="card-title mb-0">Daftar Tugas</h5>
                    <small class="text-muted">Total: {{ $assignments->total() }} tugas</small>
                </div>
            </div>

            <div class="card-body">
                @if($assignments->isEmpty())
                    <div class="text-center py-5">
                        <div class="mb-3">
                            <span class="avatar-text avatar-lg rounded-circle bg-light text-primary">
                                <i class="fas fa-book-open"></i>
                            </span>
                        </div>
                        <h5 class="mb-2">Belum ada tugas</h5>
                        <p class="text-muted mb-3">Tambahkan tugas baru agar siswa bisa mulai mengerjakan.</p>
                        <a href="{{ route('teacher.assignments.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus me-1"></i> Buat Tugas Pertama
                        </a>
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="ps-3">Judul</th>
                                    <th>Kelas</th>
                                    <th>Deadline</th>
                                    <th>Status</th>
                                    <th class="text-end pe-3">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($assignments as $assignment)
                                    <tr>
                                        <td class="ps-3">
                                            <div class="fw-semibold text-dark">{{ $assignment->title }}</div>
                                            <small class="text-muted">Tugas pembelajaran siswa</small>
                                        </td>
                                        <td>
                                            <span class="badge bg-soft-primary text-primary">
                                                {{ $assignment->class->name ?? '-' }}
                                            </span>
                                        </td>
                                        <td>
                                            @if($assignment->due_date)
                                                <div class="fw-semibold">{{ $assignment->due_date->format('d M Y') }}</div>
                                            @else
                                                <span class="text-muted">Belum diatur</span>
                                            @endif
                                        </td>
                                        <td>
                                            @php
                                                $status = strtolower($assignment->status ?? '');
                                                $statusClass = match($status) {
                                                    'aktif', 'active', 'published' => 'success',
                                                    'draft' => 'warning',
                                                    'selesai', 'closed', 'done' => 'secondary',
                                                    default => 'primary',
                                                };
                                            @endphp
                                            <span class="badge bg-{{ $statusClass }}">
                                                {{ ucfirst($assignment->status ?? 'Aktif') }}
                                            </span>
                                        </td>
                                        <td class="text-end pe-3">
                                            <div class="d-inline-flex gap-2">
                                                <a href="{{ route('teacher.assignments.edit', $assignment) }}" class="btn btn-sm btn-outline-primary">
                                                    Edit
                                                </a>
                                                <form action="{{ route('teacher.assignments.destroy', $assignment) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Hapus tugas ini?')">
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
                        {{ $assignments->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection