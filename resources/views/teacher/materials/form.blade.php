@extends('layouts.admin')

@php
    $isEdit = isset($material);
@endphp

@section('content')
<div class="row g-4">
    <div class="col-12">
        <div class="card stretch stretch-full">
            <div class="card-body">
                <div class="d-flex flex-column flex-lg-row align-items-start align-items-lg-center justify-content-between gap-3">
                    <div>
                        <h3 class="mb-1">{{ $isEdit ? 'Edit Materi' : 'Tambah Materi Baru' }}</h3>
                        <p class="text-muted mb-0">Tambahkan materi pembelajaran yang akan dibagikan ke siswa.</p>
                    </div>
                    <a href="{{ route('teacher.materials.index') }}" class="btn btn-outline-secondary">
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
                <form action="{{ $isEdit ? route('teacher.materials.update', $material) : route('teacher.materials.store') }}" method="POST">
                    @csrf
                    @if($isEdit)
                        @method('PUT')
                    @endif

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Judul Materi</label>
                            <input type="text" name="title" class="form-control" value="{{ old('title', $material->title ?? '') }}" placeholder="Contoh: Materi Sistem Tata Surya" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Kelas</label>
                            <select name="teacher_class_id" class="form-select" required>
                                <option value="">Pilih kelas</option>
                                @foreach($classes as $class)
                                    <option value="{{ $class->id }}" {{ old('teacher_class_id', $material->teacher_class_id ?? '') == $class->id ? 'selected' : '' }}>
                                        {{ $class->name }} - {{ $class->subject }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Jenis Materi</label>
                            <input type="text" name="type" class="form-control" value="{{ old('type', $material->type ?? '') }}" placeholder="PDF / Video / PPT / Link">
                        </div>

                        <div class="col-md-8">
                            <label class="form-label fw-semibold">Link Materi</label>
                            <input type="url" name="link" class="form-control" value="{{ old('link', $material->link ?? '') }}" placeholder="https://...">
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-semibold">Catatan</label>
                            <textarea name="notes" class="form-control" rows="4" placeholder="Tambahkan ringkasan materi, instruksi, atau poin penting">{{ old('notes', $material->notes ?? '') }}</textarea>
                        </div>
                    </div>

                    <div class="d-flex flex-wrap gap-2 mt-4">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i>
                            {{ $isEdit ? 'Simpan Perubahan' : 'Simpan Materi' }}
                        </button>
                        <a href="{{ route('teacher.materials.index') }}" class="btn btn-light border">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection