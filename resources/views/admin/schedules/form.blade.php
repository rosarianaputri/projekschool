@extends('layouts.admin')

@php
    $isEdit = isset($schedule);
@endphp

@section('content')
<div class="row g-4">
    <div class="col-12">
        <div class="card stretch stretch-full">
            <div class="card-body">
                <div class="d-flex flex-column flex-lg-row align-items-start align-items-lg-center justify-content-between gap-3">
                    <div>
                        <h3 class="mb-1">{{ $isEdit ? 'Edit Jadwal' : 'Tambah Jadwal Baru' }}</h3>
                        <p class="text-muted mb-0">Admin menentukan jadwal kelas agar guru dan siswa tinggal mengikuti jadwal yang tersedia.</p>
                    </div>
                    <a href="{{ route('schedules.index') }}" class="btn btn-outline-secondary">
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
                <form action="{{ $isEdit ? route('schedules.update', $schedule) : route('schedules.store') }}" method="POST">
                    @csrf
                    @if($isEdit)
                        @method('PUT')
                    @endif

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Kelas</label>
                            <select name="teacher_class_id" class="form-select" required>
                                <option value="">Pilih kelas</option>
                                @foreach($classes as $class)
                                    <option value="{{ $class->id }}" {{ old('teacher_class_id', $schedule->teacher_class_id ?? '') == $class->id ? 'selected' : '' }}>
                                        {{ $class->name }} - {{ $class->subject }} ({{ $class->teacher->name ?? '-' }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Hari</label>
                            <select name="day" class="form-select" required>
                                <option value="">Pilih hari</option>
                                @foreach(['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'] as $day)
                                    <option value="{{ $day }}" {{ old('day', $schedule->day ?? '') == $day ? 'selected' : '' }}>
                                        {{ $day }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Jam Mulai</label>
                            <input
                                type="time"
                                name="start_time"
                                class="form-control"
                                value="{{ old('start_time', $schedule->start_time ?? '') }}"
                                required
                            >
                        </div>

                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Jam Selesai</label>
                            <input
                                type="time"
                                name="end_time"
                                class="form-control"
                                value="{{ old('end_time', $schedule->end_time ?? '') }}"
                                required
                            >
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Ruang</label>
                            <input
                                type="text"
                                name="room"
                                class="form-control"
                                value="{{ old('room', $schedule->room ?? '') }}"
                                placeholder="Contoh: Ruang 101 / Lab Komputer"
                            >
                        </div>
                    </div>

                    <div class="d-flex flex-wrap gap-2 mt-4">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i>
                            {{ $isEdit ? 'Simpan Perubahan' : 'Simpan Jadwal' }}
                        </button>
                        <a href="{{ route('schedules.index') }}" class="btn btn-light border">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection