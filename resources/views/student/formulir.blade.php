@extends('layouts.student')

@php
    $title = 'Dashboard Siswa - Formulir Pendaftaran';
@endphp

@section('content')
<div class="nxl-content-right">
    <div class="nxl-content-inner" style="padding-top: 60px; padding-left: 40px; padding-right: 40px; padding-bottom: 40px;">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4 p-md-5">
                <h2 class="text-center mb-2 text-primary">Formulir Pendaftaran PPDB</h2>
                <p class="text-center text-muted mb-4">Isi data dengan benar. Data akan diproses admin untuk persetujuan (ACC).</p>

                @if (session('status') === 'ppdb_submitted')
                    <div class="alert alert-success text-center">
                        Formulir berhasil disimpan.<br>
                        Nomor pendaftaran Anda: <strong>{{ session('registration_code') }}</strong>
                    </div>
                @endif

                <form method="POST" action="{{ route('student.ppdb.store') }}">
                    @csrf

                    <div class="row g-4">
                        <div class="col-md-6">
                            <label class="form-label">Nama Lengkap Siswa</label>
                            <input type="text" name="student_name" class="form-control" value="{{ old('student_name', $application->student_name ?? $user->name) }}" required>
                            @error('student_name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Jenis Kelamin</label>
                            <select name="gender" class="form-control" required>
                                <option value="">Pilih</option>
                                <option value="L" {{ old('gender', $application->gender ?? '') === 'L' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="P" {{ old('gender', $application->gender ?? '') === 'P' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                            @error('gender')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Tempat Lahir</label>
                            <input type="text" name="birth_place" class="form-control" value="{{ old('birth_place', $application->birth_place ?? '') }}" required>
                            @error('birth_place')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Tanggal Lahir</label>
                            <input type="date" name="birth_date" class="form-control" value="{{ old('birth_date', optional($application?->birth_date)->format('Y-m-d')) }}" required>
                            @error('birth_date')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Asal Sekolah</label>
                            <input type="text" name="previous_school" class="form-control" value="{{ old('previous_school', $application->previous_school ?? '') }}">
                            @error('previous_school')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Nama Orang Tua / Wali</label>
                            <input type="text" name="parent_name" class="form-control" value="{{ old('parent_name', $application->parent_name ?? '') }}" required>
                            @error('parent_name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Nomor HP</label>
                            <input type="text" name="phone" class="form-control" value="{{ old('phone', $application->phone ?? '') }}" required>
                            @error('phone')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" value="{{ $user->email }}" readonly>
                        </div>

                        <div class="col-12">
                            <label class="form-label">Alamat</label>
                            <textarea name="address" rows="3" class="form-control" required>{{ old('address', $application->address ?? '') }}</textarea>
                            @error('address')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-12">
                            <label class="form-label">Catatan Tambahan</label>
                            <textarea name="notes" rows="3" class="form-control">{{ old('notes', $application->notes ?? '') }}</textarea>
                            @error('notes')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        <a href="{{ route('student.dashboard') }}" class="btn btn-outline-secondary">Kembali</a>
                        <button type="submit" class="btn btn-primary px-4">Simpan Formulir</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
