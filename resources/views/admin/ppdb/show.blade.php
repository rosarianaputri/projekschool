@extends('layouts.admin')

@php
    $title = 'LaylaSchool || Detail PPDB';
    $pageTitle = 'Detail Pendaftar PPDB';
@endphp

@section('content')
    <div class="card">
        <div class="card-body">
            @if (session('status') === 'ppdb_updated')
                <div class="alert alert-success">Data pendaftar berhasil diperbarui.</div>
            @elseif (session('status') === 'ppdb_approved')
                <div class="alert alert-success">Pendaftar berhasil di-ACC.</div>
            @elseif (session('status') === 'ppdb_assigned')
                <div class="alert alert-success">Pendaftar berhasil disambungkan ke kelas.</div>
            @elseif (session('status') === 'ppdb_rejected')
                <div class="alert alert-warning">Pendaftar berhasil ditolak.</div>
            @endif

            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="mb-0">{{ $application->registration_code }}</h5>
                <div class="d-flex gap-2">
                    <a href="{{ route('admin.ppdb.edit', $application) }}" class="btn btn-info btn-sm text-white">Edit</a>
                    <a href="{{ route('admin.ppdb.index') }}" class="btn btn-outline-secondary btn-sm">Kembali</a>
                </div>
            </div>

            <div class="mb-4 p-3 rounded bg-light border">
                <h6 class="mb-2">Sambungkan ke Kelas</h6>
                @if($classes->isEmpty())
                    <div class="text-muted">
                        Belum ada kelas tersedia. Buat kelas dulu melalui halaman kelas guru agar siswa ini dapat ditempatkan.
                    </div>
                @else
                    <form method="POST" action="{{ route('admin.ppdb.assign', $application) }}">
                        @csrf
                        @method('PATCH')
                        <div class="row g-3 align-items-end">
                            <div class="col-md-8">
                                <label class="form-label">Pilih Kelas</label>
                                <select name="teacher_class_id" class="form-select">
                                    <option value="">-- Pilih kelas --</option>
                                    @foreach($classes as $class)
                                        <option value="{{ $class->id }}">{{ $class->name }} @if($class->teacher) - {{ $class->teacher->name }} @endif</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary w-100">Sambungkan ke Kelas</button>
                            </div>
                        </div>
                    </form>
                @endif
            </div>

            <div class="row g-3">
                <div class="col-md-6"><strong>Nama Siswa:</strong><br>{{ $application->student_name }}</div>
                <div class="col-md-6"><strong>Jenis Kelamin:</strong><br>{{ $application->gender === 'L' ? 'Laki-laki' : 'Perempuan' }}</div>
                <div class="col-md-6"><strong>Tempat, Tanggal Lahir:</strong><br>{{ $application->birth_place }}, {{ $application->birth_date?->format('d-m-Y') }}</div>
                <div class="col-md-6"><strong>Asal Sekolah:</strong><br>{{ $application->previous_school ?: '-' }}</div>
                <div class="col-md-6"><strong>Nama Orang Tua/Wali:</strong><br>{{ $application->parent_name }}</div>
                <div class="col-md-6"><strong>No. HP:</strong><br>{{ $application->phone }}</div>
                <div class="col-md-6"><strong>Email:</strong><br>{{ $application->email }}</div>
                <div class="col-md-6"><strong>Status:</strong><br>
                    @if ($application->status === 'approved')
                        <span class="badge bg-success">ACC</span>
                    @elseif ($application->status === 'rejected')
                        <span class="badge bg-danger">Ditolak</span>
                    @else
                        <span class="badge bg-warning text-dark">Pending</span>
                    @endif
                </div>
                <div class="col-12"><strong>Alamat:</strong><br>{{ $application->address }}</div>
                <div class="col-12"><strong>Catatan:</strong><br>{{ $application->notes ?: '-' }}</div>
            </div>

            <div class="d-flex flex-wrap gap-2 mt-4">
                @if ($application->status !== 'approved')
                    <form method="POST" action="{{ route('admin.ppdb.acc', $application) }}">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-success">ACC Pendaftaran</button>
                    </form>
                @endif

                @if ($application->status !== 'rejected')
                    <form method="POST" action="{{ route('admin.ppdb.reject', $application) }}">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-warning">Tolak Pendaftaran</button>
                    </form>
                @endif

                <form method="POST" action="{{ route('admin.ppdb.destroy', $application) }}" onsubmit="return confirm('Hapus data pendaftar ini?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
            </div>
        </div>
    </div>
@endsection
