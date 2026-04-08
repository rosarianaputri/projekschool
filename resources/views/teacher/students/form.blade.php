@extends('layouts.admin')

@section('content')
<div class="mb-4">
    <h4>{{ isset($student) ? 'Edit Siswa' : 'Tambah Siswa Baru' }}</h4>
    <p class="text-muted">Isi profil siswa agar data kelas dan laporan bisa lebih lengkap.</p>
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

<form action="{{ isset($student) ? route('teacher.students.update', $student) : route('teacher.students.store') }}" method="POST">
    @csrf
    @if(isset($student))
        @method('PUT')
    @endif

    <div class="row g-3">
        <div class="col-md-6">
            <label class="form-label">Nama Siswa</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $student->name ?? '') }}" required>
        </div>
        <div class="col-md-6">
            <label class="form-label">NIS</label>
            <input type="text" name="nis" class="form-control" value="{{ old('nis', $student->nis ?? '') }}">
        </div>
        <div class="col-md-6">
            <label class="form-label">Kelas</label>
            <select name="teacher_class_id" class="form-select">
                <option value="">Pilih kelas</option>
                @foreach($classes as $class)
                    <option value="{{ $class->id }}" {{ old('teacher_class_id', $student->teacher_class_id ?? '') == $class->id ? 'selected' : '' }}>{{ $class->name }} - {{ $class->subject }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-6">
            <label class="form-label">HP / Email</label>
            <input type="text" name="phone" class="form-control mb-2" placeholder="Nomor HP" value="{{ old('phone', $student->phone ?? '') }}">
            <input type="email" name="email" class="form-control" placeholder="Email" value="{{ old('email', $student->email ?? '') }}">
        </div>
        <div class="col-12">
            <label class="form-label">Catatan Guru</label>
            <textarea name="notes" class="form-control" rows="4">{{ old('notes', $student->notes ?? '') }}</textarea>
        </div>
    </div>

    <div class="mt-4">
        <button type="submit" class="btn btn-primary">{{ isset($student) ? 'Simpan Perubahan' : 'Tambah Siswa' }}</button>
        <a href="{{ route('teacher.students.index') }}" class="btn btn-outline-secondary">Kembali</a>
    </div>
</form>
@endsection
