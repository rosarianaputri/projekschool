@extends('layouts.admin')

@php
    $isEdit = isset($student);
@endphp

@section('content')
<div class="row g-4">
    <div class="col-12">
        <div class="card stretch stretch-full">
            <div class="card-body">
                <div class="d-flex flex-column flex-lg-row align-items-start align-items-lg-center justify-content-between gap-3">
                    <div>
                        <h3 class="mb-1">{{ $isEdit ? 'Edit Siswa' : 'Tambah Siswa Baru' }}</h3>
                        <p class="text-muted mb-0">Lengkapi profil siswa agar data kelas, materi, dan laporan bisa tersusun rapi.</p>
                    </div>
                    <a href="{{ route('teacher.students.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left me-1"></i> Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>

    @if($errors->any())
        <div class="col-12">
            <div class="alert alert-danger border-0 shadow-sm mb-0">
                <div class="fw-semibold mb-2">Periksa kembali input berikut:</div>
                <ul class="mb-0 ps-3">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    <div class="col-12">
        <div class="card stretch stretch-full">
            <div class="card-body">
                <form action="{{ $isEdit ? route('teacher.students.update', $student) : route('teacher.students.store') }}" method="POST">
                    @csrf
                    @if($isEdit)
                        @method('PUT')
                    @endif

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Nama Siswa</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name', $student->name ?? '') }}" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">NIS</label>
                            <input type="text" name="nis" class="form-control" value="{{ old('nis', $student->nis ?? '') }}">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Kelas</label>
                            <select name="teacher_class_id" class="form-select">
                                <option value="">Pilih kelas</option>
                                @foreach($classes as $class)
                                    <option value="{{ $class->id }}" {{ old('teacher_class_id', $student->teacher_class_id ?? '') == $class->id ? 'selected' : '' }}>
                                        {{ $class->name }} - {{ $class->subject }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Nomor HP</label>
                            <input type="text" name="phone" class="form-control" value="{{ old('phone', $student->phone ?? '') }}" placeholder="08xxxxxxxx">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Email</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email', $student->email ?? '') }}" placeholder="email@gmail.com">
                            <small class="text-muted">Gunakan email yang sama dengan akun siswa agar materi bisa muncul di dashboard siswa.</small>
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-semibold">Catatan Guru</label>
                            <textarea name="notes" class="form-control" rows="4">{{ old('notes', $student->notes ?? '') }}</textarea>
                        </div>
                    </div>

                    <div class="d-flex flex-wrap gap-2 mt-4">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i> {{ $isEdit ? 'Simpan Perubahan' : 'Simpan Siswa' }}
                        </button>
                        <a href="{{ route('teacher.students.index') }}" class="btn btn-light border">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection