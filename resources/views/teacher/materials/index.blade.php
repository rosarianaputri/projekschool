@extends('layouts.admin')

@php
    $title = 'LaylaSchool || Materi Guru';
    $pageTitle = 'Materi';
@endphp

@section('content')
<div class="row g-4">

    <div class="col-12">
        <div class="card stretch stretch-full">
            <div class="card-body">
                <div class="d-flex flex-column flex-lg-row align-items-start align-items-lg-center justify-content-between gap-3">
                    <div>
                        <h3 class="mb-1">Manajemen Materi</h3>
                        <p class="text-muted mb-0">Simpan materi pembelajaran, lampiran, atau tautan referensi untuk setiap kelas.</p>
                    </div>
                    <a href="{{ route('teacher.materials.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus me-1"></i> Tambah Materi
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
                    <h5 class="card-title mb-0">Daftar Materi</h5>
                    <small class="text-muted">Total: {{ $materials->total() }} materi</small>
                </div>
            </div>

            <div class="card-body">
                @if($materials->isEmpty())
                    <div class="text-center py-5">
                        <div class="mb-3">
                            <span class="avatar-text avatar-lg rounded-circle bg-light text-primary">
                                <i class="fas fa-folder-open"></i>
                            </span>
                        </div>
                        <h5 class="mb-2">Belum ada materi</h5>
                        <p class="text-muted mb-3">Tambahkan materi agar siswa bisa mengakses bahan belajar dengan mudah.</p>
                        <a href="{{ route('teacher.materials.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus me-1"></i> Tambah Materi
                        </a>
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="ps-3">Judul</th>
                                    <th>Kelas</th>
                                    <th>Jenis</th>
                                    <th>Link</th>
                                    <th class="text-end pe-3">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($materials as $material)
                                    <tr>
                                        <td class="ps-3">
                                            <div class="fw-semibold text-dark">{{ $material->title }}</div>
                                            <small class="text-muted">Materi pembelajaran untuk siswa</small>
                                        </td>
                                        <td>
                                            <span class="badge bg-soft-primary text-primary">
                                                {{ $material->class->name ?? '-' }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge bg-light text-dark border">
                                                {{ $material->type ?: 'Umum' }}
                                            </span>
                                        </td>
                                        <td>
                                            @if($material->link)
                                                <a href="{{ $material->link }}" target="_blank" class="btn btn-sm btn-outline-success">
                                                    Buka Link
                                                </a>
                                            @else
                                                <span class="text-muted">Tidak ada link</span>
                                            @endif
                                        </td>
                                        <td class="text-end pe-3">
                                            <div class="d-inline-flex gap-2">
                                                <a href="{{ route('teacher.materials.edit', $material) }}" class="btn btn-sm btn-outline-primary">
                                                    Edit
                                                </a>
                                                <form action="{{ route('teacher.materials.destroy', $material) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Hapus materi ini?')">
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
                        {{ $materials->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection