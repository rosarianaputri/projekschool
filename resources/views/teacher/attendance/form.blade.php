@extends('layouts.admin')

@section('content')
<div class="mb-4">
    <h4>{{ isset($attendance) ? 'Edit Absensi' : 'Tambah Absensi Baru' }}</h4>
    <p class="text-muted">Isi laporan kehadiran untuk kelas dan tanggal yang dipilih.</p>
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

<form action="{{ isset($attendance) ? route('teacher.attendance.update', $attendance) : route('teacher.attendance.store') }}" method="POST">
    @csrf
    @if(isset($attendance))
        @method('PUT')
    @endif

    <div class="row g-3">
        <div class="col-md-6">
            <label class="form-label">Tanggal</label>
            <input type="date" name="date" class="form-control" value="{{ old('date', isset($attendance) ? $attendance->date->format('Y-m-d') : '') }}" required>
        </div>
        <div class="col-md-6">
            <label class="form-label">Kelas</label>
            <select name="teacher_class_id" class="form-select">
                <option value="">Pilih kelas</option>
                @foreach($classes as $class)
                    <option value="{{ $class->id }}" {{ old('teacher_class_id', $attendance->teacher_class_id ?? '') == $class->id ? 'selected' : '' }}>{{ $class->name }} - {{ $class->subject }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3">
            <label class="form-label">Hadir</label>
            <input type="number" min="0" name="present" class="form-control" value="{{ old('present', $attendance->present ?? 0) }}" required>
        </div>
        <div class="col-md-3">
            <label class="form-label">Izin</label>
            <input type="number" min="0" name="permission" class="form-control" value="{{ old('permission', $attendance->permission ?? 0) }}" required>
        </div>
        <div class="col-md-3">
            <label class="form-label">Sakit</label>
            <input type="number" min="0" name="sick" class="form-control" value="{{ old('sick', $attendance->sick ?? 0) }}" required>
        </div>
        <div class="col-md-3">
            <label class="form-label">Alfa</label>
            <input type="number" min="0" name="absent" class="form-control" value="{{ old('absent', $attendance->absent ?? 0) }}" required>
        </div>
        <div class="col-12">
            <label class="form-label">Catatan</label>
            <textarea name="note" class="form-control" rows="3">{{ old('note', $attendance->note ?? '') }}</textarea>
        </div>
    </div>

    <div class="mt-4">
        <button type="submit" class="btn btn-primary">{{ isset($attendance) ? 'Simpan Perubahan' : 'Simpan Absensi' }}</button>
        <a href="{{ route('teacher.attendance.index') }}" class="btn btn-outline-secondary">Kembali</a>
    </div>
</form>
@endsection
