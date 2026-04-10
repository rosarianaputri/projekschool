@extends('layouts.admin')

@section('content')
<div class="mb-4">
    <h4>{{ isset($teacher_class) ? 'Edit Kelas' : 'Buat Kelas Baru' }}</h4>
    <p class="text-muted">Isi detail kelas agar bisa dilihat dan dikelola di dashboard guru.</p>
</div>

@if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="feather-alert-circle me-2"></i>
        <strong>Ada kesalahan!</strong>
        <ul class="mb-0 mt-2">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<form action="{{ isset($teacher_class) ? route('teacher.classes.update', $teacher_class) : route('teacher.classes.store') }}" method="POST">
    @csrf
    @if(isset($teacher_class))
        @method('PUT')
    @endif

    <div class="card">
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label fw-500">
                        <i class="feather-book me-2"></i>Nama Kelas
                    </label>
                    <input 
                        type="text" 
                        name="name" 
                        class="form-control @error('name') is-invalid @enderror" 
                        value="{{ old('name', $teacher_class->name ?? '') }}" 
                        placeholder="Contoh: 10A, X IPA 1"
                        required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-500">
                        <i class="feather-layers me-2"></i>Mata Pelajaran
                    </label>
                    <input 
                        type="text" 
                        name="subject" 
                        class="form-control @error('subject') is-invalid @enderror" 
                        value="{{ old('subject', $teacher_class->subject ?? '') }}" 
                        placeholder="Contoh: Matematika, Bahasa Inggris"
                        required>
                    @error('subject')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4">
                    <label class="form-label fw-500">
                        <i class="feather-calendar me-2"></i>Semester
                    </label>
                    <select name="semester" class="form-select @error('semester') is-invalid @enderror">
                        <option value="">-- Pilih Semester --</option>
                        <option value="1" {{ old('semester', $teacher_class->semester ?? '') === '1' ? 'selected' : '' }}>Semester 1</option>
                        <option value="2" {{ old('semester', $teacher_class->semester ?? '') === '2' ? 'selected' : '' }}>Semester 2</option>
                    </select>
                    @error('semester')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4">
                    <label class="form-label fw-500">
                        <i class="feather-clock me-2"></i>Jadwal
                    </label>
                    <input 
                        type="text" 
                        name="schedule" 
                        class="form-control @error('schedule') is-invalid @enderror" 
                        value="{{ old('schedule', $teacher_class->schedule ?? '') }}" 
                        placeholder="Contoh: Senin, 10:00 - 11:30">
                    @error('schedule')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4">
                    <label class="form-label fw-500">
                        <i class="feather-home me-2"></i>Ruang
                    </label>
                    <input 
                        type="text" 
                        name="room" 
                        class="form-control @error('room') is-invalid @enderror" 
                        value="{{ old('room', $teacher_class->room ?? '') }}" 
                        placeholder="Contoh: Lab 1, Kelas 10A">
                    @error('room')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
    </div>

    <div class="mt-4 d-flex gap-2">
        <button type="submit" class="btn btn-primary">
            <i class="feather-save me-2"></i>{{ isset($teacher_class) ? 'Simpan Perubahan' : 'Buat Kelas' }}
        </button>
        <a href="{{ route('teacher.classes.index') }}" class="btn btn-outline-secondary">
            <i class="feather-arrow-left me-2"></i>Kembali
        </a>
    </div>
</form>
@endsection
