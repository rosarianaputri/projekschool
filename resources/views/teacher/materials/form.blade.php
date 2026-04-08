@extends('layouts.admin')

@section('content')
<div class="mb-4">
    <h4>{{ isset($material) ? 'Edit Materi' : 'Tambah Materi Baru' }}</h4>
    <p class="text-muted">Tambahkan materi pembelajaran berupa tautan, dokumen, atau referensi kelas.</p>
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

<form action="{{ isset($material) ? route('teacher.materials.update', $material) : route('teacher.materials.store') }}" method="POST">
    @csrf
    @if(isset($material))
        @method('PUT')
    @endif

    <div class="row g-3">
        <div class="col-md-6">
            <label class="form-label">Judul Materi</label>
            <input type="text" name="title" class="form-control" value="{{ old('title', $material->title ?? '') }}" required>
        </div>
        <div class="col-md-6">
            <label class="form-label">Kelas</label>
            <select name="teacher_class_id" class="form-select">
                <option value="">Pilih kelas</option>
                @foreach($classes as $class)
                    <option value="{{ $class->id }}" {{ old('teacher_class_id', $material->teacher_class_id ?? '') == $class->id ? 'selected' : '' }}>{{ $class->name }} - {{ $class->subject }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4">
            <label class="form-label">Jenis Materi</label>
            <input type="text" name="type" class="form-control" value="{{ old('type', $material->type ?? '') }}" placeholder="PDF / Video / Link">
        </div>
        <div class="col-md-8">
            <label class="form-label">Link / File</label>
            <input type="text" name="link" class="form-control" value="{{ old('link', $material->link ?? '') }}" placeholder="https://...">
        </div>
        <div class="col-12">
            <label class="form-label">Catatan</label>
            <textarea name="notes" class="form-control" rows="3">{{ old('notes', $material->notes ?? '') }}</textarea>
        </div>
    </div>

    <div class="mt-4">
        <button type="submit" class="btn btn-primary">{{ isset($material) ? 'Simpan Perubahan' : 'Simpan Materi' }}</button>
        <a href="{{ route('teacher.materials.index') }}" class="btn btn-outline-secondary">Kembali</a>
    </div>
</form>
@endsection
