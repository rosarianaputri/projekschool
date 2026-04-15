@extends('layouts.admin')

@php
    $isEdit = isset($teacher_class);
@endphp

@section('content')
<div class="row g-4">
    <div class="col-12">
        <div class="card stretch stretch-full">
            <div class="card-body">
                <div class="d-flex flex-column flex-lg-row align-items-start align-items-lg-center justify-content-between gap-3">
                    <div>
                        <h3 class="mb-1">{{ $isEdit ? 'Edit Kelas' : 'Tambah Kelas Baru' }}</h3>
                        <p class="text-muted mb-0">Admin mengatur kelas dan menentukan guru pengampu untuk tiap kelas.</p>
                    </div>
                    <a href="{{ route('admin.classes.index') }}" class="btn btn-outline-secondary">
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
                <form action="{{ $isEdit ? route('admin.classes.update', $teacher_class) : route('admin.classes.store') }}" method="POST">
                    @csrf
                    @if($isEdit)
                        @method('PUT')
                    @endif

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Nama Kelas</label>
                            <input
                                type="text"
                                name="name"
                                class="form-control"
                                value="{{ old('name', $teacher_class->name ?? '') }}"
                                placeholder="Contoh: X IPA 1"
                                required
                            >
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Guru Pengampu</label>
                            <select name="teacher_id" class="form-select" required>
                                <option value="">Pilih guru</option>
                                @foreach($teachers as $teacher)
                                    <option value="{{ $teacher->id }}" {{ old('teacher_id', $teacher_class->teacher_id ?? '') == $teacher->id ? 'selected' : '' }}>
                                        {{ $teacher->name }}{{ $teacher->position ? ' - '.$teacher->position : '' }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Mata Pelajaran</label>
                            <input
                                type="text"
                                name="subject"
                                class="form-control"
                                value="{{ old('subject', $teacher_class->subject ?? '') }}"
                                placeholder="Contoh: Matematika"
                                required
                            >
                        </div>

                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Semester</label>
                            <select name="semester" class="form-select">
                                <option value="">Pilih semester</option>
                                <option value="1" {{ old('semester', $teacher_class->semester ?? '') == '1' ? 'selected' : '' }}>Semester 1</option>
                                <option value="2" {{ old('semester', $teacher_class->semester ?? '') == '2' ? 'selected' : '' }}>Semester 2</option>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Ruang</label>
                            <input
                                type="text"
                                name="room"
                                class="form-control"
                                value="{{ old('room', $teacher_class->room ?? '') }}"
                                placeholder="Contoh: Ruang 101"
                            >
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-semibold">Jadwal Ringkas</label>
                            <input
                                type="text"
                                name="schedule"
                                class="form-control"
                                value="{{ old('schedule', $teacher_class->schedule ?? '') }}"
                                placeholder="Contoh: Senin, 08:00 - 09:30"
                            >
                            <small class="text-muted">Ini sementara hanya ringkasan. Nanti jadwal detail akan kita pindahkan penuh ke admin.</small>
                        </div>
                    </div>

                    <div class="d-flex flex-wrap gap-2 mt-4">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i>
                            {{ $isEdit ? 'Simpan Perubahan' : 'Simpan Kelas' }}
                        </button>
                        <a href="{{ route('admin.classes.index') }}" class="btn btn-light border">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection