@extends('layouts.admin')

@php
    $title = 'Data Guru';
    $pageTitle = 'Data Guru';
@endphp

@section('content')
<div class="row g-4">
    <div class="col-12">
        <div class="card stretch stretch-full">
            <div class="card-body">
                <div class="d-flex flex-column flex-lg-row align-items-start align-items-lg-center justify-content-between gap-3">
                    <div>
                        <h3 class="mb-1">Manajemen Guru</h3>
                        <p class="text-muted mb-0">Kelola data guru dan akun login guru dari panel admin.</p>
                    </div>
                    <a href="{{ route('admin.teachers.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus me-1"></i> Tambah Guru
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
                    <h5 class="card-title mb-0">Daftar Guru</h5>
                    <small class="text-muted">Total: {{ $teachers->total() }} guru</small>
                </div>
            </div>

            <div class="card-body">
                @if($teachers->isEmpty())
                    <div class="text-center py-5">
                        <h5 class="mb-2">Belum ada data guru</h5>
                        <p class="text-muted mb-3">Tambahkan data guru untuk mulai mengelola akun dan kelas.</p>
                        <a href="{{ route('admin.teachers.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus me-1"></i> Tambah Guru
                        </a>
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="ps-3">Nama</th>
                                    <th>Email</th>
                                    <th>NIP</th>
                                    <th>Jabatan</th>
                                    <th>No HP</th>
                                    <th>Akun</th>
                                    <th class="text-end pe-3">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($teachers as $teacher)
                                    <tr>
                                        <td class="ps-3">
                                            <div class="fw-semibold text-dark">{{ $teacher->name }}</div>
                                            <small class="text-muted">Data tenaga pengajar</small>
                                        </td>
                                        <td>{{ $teacher->email ?: '-' }}</td>
                                        <td>{{ $teacher->nip ?: '-' }}</td>
                                        <td>{{ $teacher->position ?: '-' }}</td>
                                        <td>{{ $teacher->phone ?: '-' }}</td>
                                        <td>
                                            @if(optional($teacher->user)->email)
                                                <span class="badge bg-soft-success text-success">
                                                    {{ $teacher->user->email }}
                                                </span>
                                            @else
                                                <span class="badge bg-light text-dark border">Belum terhubung</span>
                                            @endif
                                        </td>
                                        <td class="text-end pe-3">
                                            <div class="d-inline-flex gap-2">
                                                <a href="{{ route('admin.teachers.edit', $teacher->id) }}" class="btn btn-sm btn-outline-primary">
                                                    Edit
                                                </a>
                                                <form action="{{ route('admin.teachers.destroy', $teacher->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Hapus guru ini?')">
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
                        {{ $teachers->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection