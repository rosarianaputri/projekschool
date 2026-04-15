@extends('layouts.admin')

@php
    $isEdit = isset($assignment);
@endphp

@section('content')
<div class="row g-4">
    <div class="col-12">
        <div class="card stretch stretch-full">
            <div class="card-body">
                <div class="d-flex flex-column flex-lg-row align-items-start align-items-lg-center justify-content-between gap-3">
                    <div>
                        <h3 class="mb-1">{{ $isEdit ? 'Edit Tugas' : 'Tambah Tugas Baru' }}</h3>
                        <p class="text-muted mb-0">Lengkapi data tugas agar siswa bisa melihat instruksi dan deadline dengan jelas.</p>
                    </div>
                    <a href="{{ route('teacher.assignments.index') }}" class="btn btn-outline-secondary">
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
                <form action="{{ $isEdit ? route('teacher.assignments.update', $assignment) : route('teacher.assignments.store') }}" method="POST">
                    @csrf
                    @if($isEdit)
                        @method('PUT')
                    @endif

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Judul Tugas</label>
                            <input type="text" name="title" class="form-control" value="{{ old('title', $assignment->title ?? '') }}" placeholder="Contoh: Tugas Matematika Bab 1" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Kelas</label>
                            <select name="teacher_class_id" class="form-select" required>
                                <option value="">Pilih kelas</option>
                                @foreach($classes as $class)
                                    <option value="{{ $class->id }}" {{ old('teacher_class_id', $assignment->teacher_class_id ?? '') == $class->id ? 'selected' : '' }}>
                                        {{ $class->name }} - {{ $class->subject }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Deadline</label>
                            <input type="date" name="due_date" class="form-control" value="{{ old('due_date', isset($assignment->due_date) ? $assignment->due_date->format('Y-m-d') : '') }}">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Status</label>
                            <select name="status" class="form-select" required>
                                <option value="draft" {{ old('status', $assignment->status ?? '') === 'draft' ? 'selected' : '' }}>Draft</option>
                                <option value="published" {{ old('status', $assignment->status ?? '') === 'published' ? 'selected' : '' }}>Published</option>
                                <option value="completed" {{ old('status', $assignment->status ?? '') === 'completed' ? 'selected' : '' }}>Selesai</option>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Deskripsi Singkat</label>
                            <input type="text" name="description" class="form-control" value="{{ old('description', $assignment->description ?? '') }}" placeholder="Instruksi atau catatan singkat tugas">
                        </div>
                    </div>

                    <div class="d-flex flex-wrap gap-2 mt-4">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i>
                            {{ $isEdit ? 'Simpan Perubahan' : 'Simpan Tugas' }}
                        </button>
                        <a href="{{ route('teacher.assignments.index') }}" class="btn btn-light border">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection