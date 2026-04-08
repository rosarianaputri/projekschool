@extends('layouts.admin')

@section('content')
<div class="mb-4">
    <h4>{{ isset($assignment) ? 'Edit Tugas' : 'Tambah Tugas Baru' }}</h4>
    <p class="text-muted">Buat tugas baru dengan tanggal jatuh tempo dan status yang jelas.</p>
</div>

@if($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ isset($assignment) ? route('teacher.assignments.update', $assignment) : route('teacher.assignments.store') }}" method="POST">
    @csrf
    @if(isset($assignment))
        @method('PUT')
    @endif

    <div class="row g-3">
        <div class="col-md-6">
            <label class="form-label">Judul Tugas</label>
            <input type="text" name="title" class="form-control" value="{{ old('title', $assignment->title ?? '') }}" required>
        </div>
        <div class="col-md-6">
            <label class="form-label">Kelas</label>
            <select name="teacher_class_id" class="form-select">
                <option value="">Pilih kelas</option>
                @foreach($classes as $class)
                    <option value="{{ $class->id }}" {{ old('teacher_class_id', $assignment->teacher_class_id ?? '') == $class->id ? 'selected' : '' }}>{{ $class->name }} - {{ $class->subject }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4">
            <label class="form-label">Deadline</label>
            <input type="date" name="due_date" class="form-control" value="{{ old('due_date', isset($assignment->due_date) ? $assignment->due_date->format('Y-m-d') : '') }}">
        </div>
        <div class="col-md-4">
            <label class="form-label">Status</label>
            <select name="status" class="form-select" required>
                <option value="draft" {{ old('status', $assignment->status ?? '') === 'draft' ? 'selected' : '' }}>Draft</option>
                <option value="published" {{ old('status', $assignment->status ?? '') === 'published' ? 'selected' : '' }}>Published</option>
                <option value="completed" {{ old('status', $assignment->status ?? '') === 'completed' ? 'selected' : '' }}>Selesai</option>
            </select>
        </div>
        <div class="col-md-4">
            <label class="form-label">Jenis</label>
            <input type="text" name="description" class="form-control" value="{{ old('description', $assignment->description ?? '') }}" placeholder="Deskripsi singkat tugas">
        </div>
    </div>

    <div class="mt-4">
        <button type="submit" class="btn btn-primary">{{ isset($assignment) ? 'Simpan Perubahan' : 'Simpan Tugas' }}</button>
        <a href="{{ route('teacher.assignments.index') }}" class="btn btn-outline-secondary">Kembali</a>
    </div>
</form>
@endsection
