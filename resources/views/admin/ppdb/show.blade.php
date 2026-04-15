@extends('layouts.admin')

@php
    $title = 'Detail PPDB';
    $pageTitle = 'Detail PPDB';
@endphp

@section('content')
<div class="row g-4">

    <div class="col-12">
        <div class="card stretch stretch-full">
            <div class="card-body">
                <div class="d-flex flex-column flex-lg-row align-items-start align-items-lg-center justify-content-between gap-3">
                    <div>
                        <h3 class="mb-1">Detail Pendaftaran Siswa</h3>
                        <p class="text-muted mb-0">Tinjau data pendaftaran, ubah status, lalu tempatkan siswa ke kelas yang sesuai.</p>
                    </div>
                   <a href="{{ route('admin.ppdb.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left me-1"></i> Kembali
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

    <div class="col-lg-7">
        <div class="card stretch stretch-full">
            <div class="card-header">
                <h5 class="card-title mb-0">Informasi Siswa</h5>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label text-muted mb-1">Nama Siswa</label>
                        <div class="fw-semibold">{{ $application->student_name }}</div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label text-muted mb-1">Email</label>
                        <div class="fw-semibold">{{ $application->email }}</div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label text-muted mb-1">No HP</label>
                        <div class="fw-semibold">{{ $application->phone ?: '-' }}</div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label text-muted mb-1">Asal Sekolah</label>
                        <div class="fw-semibold">{{ $application->previous_school ?: '-' }}</div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label text-muted mb-1">Nama Orang Tua</label>
                        <div class="fw-semibold">{{ $application->parent_name ?: '-' }}</div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label text-muted mb-1">Status Saat Ini</label>
                        <div>
                            @php
                                $status = strtolower($application->status ?? 'pending');
                                $badge = match($status) {
                                    'approved' => 'success',
                                    'rejected' => 'danger',
                                    default => 'warning',
                                };
                            @endphp

                            <span class="badge bg-{{ $badge }}">
                                {{ ucfirst($application->status ?? 'Pending') }}
                            </span>
                        </div>
                    </div>

                    <div class="col-12">
                        <label class="form-label text-muted mb-1">Alamat</label>
                        <div class="fw-semibold">{{ $application->address ?: '-' }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-5">
        <div class="card stretch stretch-full mb-4">
            <div class="card-header">
                <h5 class="card-title mb-0">Ubah Status</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.ppdb.status', $application) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Status Pendaftaran</label>
                        <select name="status" class="form-select" required>
                            <option value="pending" {{ ($application->status ?? '') === 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="approved" {{ ($application->status ?? '') === 'approved' ? 'selected' : '' }}>Approved</option>
                            <option value="rejected" {{ ($application->status ?? '') === 'rejected' ? 'selected' : '' }}>Rejected</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i> Simpan Status
                    </button>
                </form>
            </div>
        </div>

        <div class="card stretch stretch-full">
            <div class="card-header">
                <h5 class="card-title mb-0">Tempatkan ke Kelas</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.ppdb.assign', $application) }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Pilih Kelas</label>
                        <select name="teacher_class_id" class="form-select" required>
                            <option value="">Pilih kelas</option>
                            @foreach($classes as $class)
                                <option value="{{ $class->id }}" {{ old('teacher_class_id', $application->teacher_class_id ?? '') == $class->id ? 'selected' : '' }}>
                                    {{ $class->name }} - {{ $class->subject }} ({{ $class->teacher->name ?? '-' }})
                                </option>
                            @endforeach
                        </select>
                        <small class="text-muted">Saat siswa ditempatkan ke kelas, data akan otomatis terhubung ke guru pengampu.</small>
                    </div>

                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-check me-1"></i> Assign ke Kelas
                    </button>
                </form>
            </div>
        </div>
    </div>

</div>
@endsection