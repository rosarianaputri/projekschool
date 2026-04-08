@extends('layouts.admin')

@section('content')
<div class="mb-4">
    <h4>{{ isset($schedule) ? 'Edit Jadwal' : 'Tambah Jadwal Baru' }}</h4>
    <p class="text-muted">Atur hari, jam, dan ruang setiap sesi mengajar.</p>
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

<form action="{{ isset($schedule) ? route('teacher.schedule.update', $schedule) : route('teacher.schedule.store') }}" method="POST">
    @csrf
    @if(isset($schedule))
        @method('PUT')
    @endif

    <div class="row g-3">
        <div class="col-md-6">
            <label class="form-label">Hari</label>
            <input type="text" name="day" class="form-control" value="{{ old('day', $schedule->day ?? '') }}" placeholder="Senin / Selasa / Rabu" required>
        </div>
        <div class="col-md-3">
            <label class="form-label">Mulai</label>
            <input type="time" name="start_time" class="form-control" value="{{ old('start_time', $schedule->start_time ?? '') }}" required>
        </div>
        <div class="col-md-3">
            <label class="form-label">Selesai</label>
            <input type="time" name="end_time" class="form-control" value="{{ old('end_time', $schedule->end_time ?? '') }}" required>
        </div>
        <div class="col-md-6">
            <label class="form-label">Kelas</label>
            <select name="teacher_class_id" class="form-select">
                <option value="">Pilih kelas</option>
                @foreach($classes as $class)
                    <option value="{{ $class->id }}" {{ old('teacher_class_id', $schedule->teacher_class_id ?? '') == $class->id ? 'selected' : '' }}>{{ $class->name }} - {{ $class->subject }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-6">
            <label class="form-label">Ruang</label>
            <input type="text" name="room" class="form-control" value="{{ old('room', $schedule->room ?? '') }}" placeholder="Contoh: 101">
        </div>
    </div>

    <div class="mt-4">
        <button type="submit" class="btn btn-primary">{{ isset($schedule) ? 'Simpan Perubahan' : 'Simpan Jadwal' }}</button>
        <a href="{{ route('teacher.schedule.index') }}" class="btn btn-outline-secondary">Kembali</a>
    </div>
</form>
@endsection
