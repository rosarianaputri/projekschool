@extends('layouts.frontend')

@php
    $title = 'Layla School - Formulir PPDB';
@endphp

@section('content')
<section class="py-5 bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-9">

                <div class="card shadow-sm">
                    <div class="card-body p-4 p-md-5">

                        <h2 class="mb-2">Formulir Pendaftaran Online PPDB</h2>
                        <p class="text-muted mb-4">
                            Isi data dengan benar. Data akan diproses admin untuk persetujuan (ACC).
                        </p>

                        {{-- Alert sukses --}}
                        @if (session('status') === 'ppdb_submitted')
                            <div class="alert alert-success">
                                Pendaftaran berhasil dikirim. 
                                Kode pendaftaran Anda: 
                                <strong>{{ session('registration_code') }}</strong>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('front.ppdb.store') }}">
                            @csrf

                            <div class="row g-3">

                                {{-- Nama --}}
                                <div class="col-md-6">
                                    <label class="form-label">Nama Lengkap Siswa</label>
                                    <input type="text"
                                           name="student_name"
                                           class="form-control"
                                           value="{{ old('student_name') }}"
                                           required>
                                    @error('student_name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                {{-- Gender --}}
                                <div class="col-md-6">
                                    <label class="form-label">Jenis Kelamin</label>
                                    <select name="gender" class="form-control" required>
                                        <option value="">Pilih</option>
                                        <option value="L" {{ old('gender') == 'L' ? 'selected' : '' }}>
                                            Laki-laki
                                        </option>
                                        <option value="P" {{ old('gender') == 'P' ? 'selected' : '' }}>
                                            Perempuan
                                        </option>
                                    </select>
                                    @error('gender')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                {{-- Tempat lahir --}}
                                <div class="col-md-6">
                                    <label class="form-label">Tempat Lahir</label>
                                    <input type="text"
                                           name="birth_place"
                                           class="form-control"
                                           value="{{ old('birth_place') }}"
                                           required>
                                    @error('birth_place')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                {{-- Tanggal lahir --}}
                                <div class="col-md-6">
                                    <label class="form-label">Tanggal Lahir</label>
                                    <input type="date"
                                           name="birth_date"
                                           class="form-control"
                                           value="{{ old('birth_date') }}"
                                           required>
                                    @error('birth_date')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                {{-- Asal sekolah --}}
                                <div class="col-md-6">
                                    <label class="form-label">Asal Sekolah (Opsional)</label>
                                    <input type="text"
                                           name="previous_school"
                                           class="form-control"
                                           value="{{ old('previous_school') }}">
                                    @error('previous_school')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                {{-- Orang tua --}}
                                <div class="col-md-6">
                                    <label class="form-label">Nama Orang Tua / Wali</label>
                                    <input type="text"
                                           name="parent_name"
                                           class="form-control"
                                           value="{{ old('parent_name') }}"
                                           required>
                                    @error('parent_name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                {{-- No HP --}}
                                <div class="col-md-6">
                                    <label class="form-label">No. HP</label>
                                    <input type="text"
                                           name="phone"
                                           class="form-control"
                                           value="{{ old('phone') }}"
                                           required>
                                    @error('phone')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                {{-- Email --}}
                                <div class="col-md-6">
                                    <label class="form-label">Email</label>
                                    <input type="email"
                                           name="email"
                                           class="form-control"
                                           value="{{ old('email') }}"
                                           required>
                                    @error('email')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                {{-- Alamat --}}
                                <div class="col-12">
                                    <label class="form-label">Alamat</label>
                                    <textarea name="address"
                                              rows="3"
                                              class="form-control"
                                              required>{{ old('address') }}</textarea>
                                    @error('address')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                {{-- Catatan --}}
                                <div class="col-12">
                                    <label class="form-label">Catatan Tambahan (Opsional)</label>
                                    <textarea name="notes"
                                              rows="3"
                                              class="form-control">{{ old('notes') }}</textarea>
                                    @error('notes')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                            </div>

                            {{-- Button --}}
                            <div class="d-flex justify-content-between mt-4">
                                <a href="{{ route('front.ppdb') }}" class="btn btn-outline-secondary">
                                    Kembali
                                </a>

                                <button type="submit" class="btn btn-primary">
                                    Kirim Pendaftaran
                                </button>
                            </div>

                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
@endsection