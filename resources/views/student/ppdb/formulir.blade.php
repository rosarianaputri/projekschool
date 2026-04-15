@extends('layouts.student')

@php
    $title = 'Formulir PPDB';
@endphp

@section('content')
<div class="container py-4">

    <div class="card">
        <div class="card-body">

            <h3 class="mb-3">Formulir Pendaftaran Siswa</h3>
            <p class="text-muted">Silakan isi data berikut dengan lengkap.</p>

            @if(session('status') == 'ppdb_submitted')
                <div class="alert alert-success">
                    Pendaftaran berhasil!<br>
                    Kode registrasi: <strong>{{ session('registration_code') }}</strong>
                </div>
            @endif

            <form action="{{ route('student.ppdb.store') }}" method="POST">
                @csrf

                <div class="row g-3">

                    <div class="col-md-6">
                        <label class="form-label">Nama Siswa</label>
                        <input type="text" name="student_name" class="form-control"
                            value="{{ old('student_name', $application->student_name ?? '') }}" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Jenis Kelamin</label>
                        <select name="gender" class="form-control" required>
                            <option value="">Pilih</option>
                            <option value="L" {{ old('gender', $application->gender ?? '') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="P" {{ old('gender', $application->gender ?? '') == 'P' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Tempat Lahir</label>
                        <input type="text" name="birth_place" class="form-control"
                            value="{{ old('birth_place', $application->birth_place ?? '') }}" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Tanggal Lahir</label>
                        <input type="date" name="birth_date" class="form-control"
                            value="{{ old('birth_date', $application->birth_date ?? '') }}" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Sekolah Asal</label>
                        <input type="text" name="previous_school" class="form-control"
                            value="{{ old('previous_school', $application->previous_school ?? '') }}" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Nama Orang Tua</label>
                        <input type="text" name="parent_name" class="form-control"
                            value="{{ old('parent_name', $application->parent_name ?? '') }}" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">No HP</label>
                        <input type="text" name="phone" class="form-control"
                            value="{{ old('phone', $application->phone ?? '') }}" required>
                    </div>

                    <div class="col-md-12">
                        <label class="form-label">Alamat</label>
                        <textarea name="address" class="form-control" rows="3" required>{{ old('address', $application->address ?? '') }}</textarea>
                    </div>

                    <div class="col-md-12">
                        <label class="form-label">Catatan (opsional)</label>
                        <textarea name="notes" class="form-control" rows="2">{{ old('notes', $application->notes ?? '') }}</textarea>
                    </div>

                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">
                        Simpan Data
                    </button>
                </div>

            </form>

        </div>
    </div>

</div>
@endsection