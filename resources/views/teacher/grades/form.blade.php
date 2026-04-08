@extends('layouts.admin')

@section('content')
<div class="mb-4">
    <h4>{{ isset($grade) ? 'Edit Nilai' : 'Tambah Nilai Baru' }}</h4>
    <p class="text-muted">Simpan nilai siswa lengkap dengan kategori dan catatan.</p>
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

<form action="{{ isset($grade) ? route('teacher.grades.update', $grade) : route('teacher.grades.store') }}" method="POST">
    @csrf
    @if(isset($grade))
        @method('PUT')
    @endif

    <div class="row g-3">
        <div class="col-md-6">
            <label class="form-label">Nama Siswa</label>
            <input type="text" name="student_name" class="form-control" value="{{ old('student_name', $grade->student_name ?? '') }}" required>
        </div>
        <div class="col-md-6">
            <label class="form-label">Kelas</label>
            <select name="teacher_class_id" class="form-select">
                <option value="">Pilih kelas</option>
                @foreach($classes as $class)
                    <option value="{{ $class->id }}" {{ old('teacher_class_id', $grade->teacher_class_id ?? '') == $class->id ? 'selected' : '' }}>{{ $class->name }} - {{ $class->subject }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-6">
            <label class="form-label">Kategori Nilai</label>
            <input type="text" name="category" class="form-control" value="{{ old('category', $grade->category ?? '') }}" placeholder="Pengetahuan / Keterampilan / Sikap">
        </div>
        <div class="col-md-3">
            <label class="form-label">Nilai</label>
            <input type="number" min="0" max="100" name="score" class="form-control" value="{{ old('score', $grade->score ?? '') }}" required>
        </div>
        <div class="col-md-3">
            <label class="form-label">Catatan</label>
            <input type="text" name="note" class="form-control" value="{{ old('note', $grade->note ?? '') }}">
        </div>
    </div>

    <div class="mt-4">
        <button type="submit" class="btn btn-primary">{{ isset($grade) ? 'Simpan Perubahan' : 'Simpan Nilai' }}</button>
        <a href="{{ route('teacher.grades.index') }}" class="btn btn-outline-secondary">Kembali</a>
    </div>
</form>
@endsection
