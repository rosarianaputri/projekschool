@extends('layouts.admin')

@php
    $title = 'Data Kelas';
    $pageTitle = 'Data Kelas';
@endphp

@section('content')
<div class="row g-4">
    <div class="col-12">
        <div class="card stretch stretch-full">
            <div class="card-body">
                <div class="d-flex flex-column flex-lg-row align-items-start align-items-lg-center justify-content-between gap-3">
                    <div>
                        <h3 class="mb-1">Manajemen Kelas</h3>
                        <p class="text-muted mb-0">Atur kelas, mata pelajaran, guru pengampu, dan informasi ruang belajar.</p>
                    </div>
                    <a href="{{ route('admin.classes.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus me-1"></i> Tambah Kelas
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
                    <h5 class="card-title mb-0">Daftar Kelas</h5>
                    <small class="text-muted">Total: {{ $classes->total() }} kelas</small>
                </div>
            </div>

            <div class="card-body">
                @if($classes->isEmpty())
                    <div class="text-center py-5">
                        <h5 class="mb-2">Belum ada kelas</h5>
                        <p class="text-muted mb-3">Tambahkan kelas terlebih dahulu agar guru dan siswa bisa terhubung.</p>
                        <a href="{{ route('admin.classes.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus me-1"></i> Tambah Kelas
                        </a>
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="ps-3">Nama Kelas</th>
                                    <th>Mapel</th>
                                    <th>Guru</th>
                                    <th>Semester</th>
                                    <th>Ruang</th>
                                    <th>Jadwal</th>
                                    <th class="text-end pe-3">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($classes as $class)
                                    <tr>
                                        <td class="ps-3">
                                            <div class="fw-semibold text-dark">{{ $class->name }}</div>
                                            <small class="text-muted">Kelas aktif sekolah</small>
                                        </td>
                                        <td>{{ $class->subject ?: '-' }}</td>
                                        <td>
                                            <span class="badge bg-soft-primary text-primary">
                                                {{ $class->teacher->name ?? '-' }}
                                            </span>
                                        </td>
                                        <td>{{ $class->semester ?: '-' }}</td>
                                        <td>{{ $class->room ?: '-' }}</td>
                                        <td>{{ $class->schedule ?: '-' }}</td>
                                        <td class="text-end pe-3">
                                            <div class="d-inline-flex gap-2">
                                                <a href="{{ route('admin.classes.edit', $class) }}" class="btn btn-sm btn-outline-primary">
                                                    Edit
                                                </a>
                                                <form action="{{ route('admin.classes.destroy', $class) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Hapus kelas ini?')">
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
                        {{ $classes->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection