@extends('layouts.admin')

@section('content')
<div class="mb-4">
    <h4>{{ isset($teacher_class) ? 'Edit Kelas' : 'Tambah Kelas Baru' }}</h4>
    <p class="text-muted">Isi detail kelas agar bisa dilihat dan dikelola di dashboard guru.</p>
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

<form action="{{ isset($teacher_class) ? route('teacher.classes.update', $teacher_class) : route('teacher.classes.store') }}" method="POST">
    @csrf
    @if(isset($teacher_class))
        @method('PUT')
    @endif

    <div class="row g-3">
        <div class="col-md-6">
            <label class="form-label">Nama Kelas</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $teacher_class->name ?? '') }}" required>
        </div>
        <div class="col-md-6">
            <label class="form-label">Mata Pelajaran</label>
            <input type="text" name="subject" class="form-control" value="{{ old('subject', $teacher_class->subject ?? '') }}" required>
        </div>
        <div class="col-md-4">
            <label class="form-label">Semester</label>
            <input type="text" name="semester" class="form-control" value="{{ old('semester', $teacher_class->semester ?? '') }}">
        </div>
        <div class="col-md-4">
            <label class="form-label">Jadwal</label>
            <input type="text" name="schedule" class="form-control" value="{{ old('schedule', $teacher_class->schedule ?? '') }}">
        </div>
        <div class="col-md-4">
            <label class="form-label">Ruang</label>
            <input type="text" name="room" class="form-control" value="{{ old('room', $teacher_class->room ?? '') }}">
        </div>
    </div>

    <div class="mt-4">
        <button type="submit" class="btn btn-primary">{{ isset($teacher_class) ? 'Simpan Perubahan' : 'Tambah Kelas' }}</button>
        <a href="{{ route('teacher.classes.index') }}" class="btn btn-outline-secondary">Kembali</a>
    </div>
</form>
@endsection
