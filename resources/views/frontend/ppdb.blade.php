@extends('layouts.frontend')

@php
    $title = 'Layla School - PPDB';
@endphp

@section('content')
    {{-- HERO FULLSCREEN --}}
    <section class="hero-section position-relative d-flex align-items-center justify-content-center text-center text-white"
        style="
            background-image: url('https://is3.cloudhost.id/spmbjabar/images/banner-ppdb-2024-Recovered.jpg');
            background-size: cover;
            background-position: center;
            height: 80vh;
        ">
        {{-- Overlay gelap transparan --}}
        <div class="position-absolute top-0 start-0 w-100 h-100"
             style="background: rgba(0, 0, 0, 0.5);"></div>

        <div class="container position-relative" style="z-index: 2;">
            <h1 class="display-4 fw-bold mb-3">PPDB 2026 - Layla School</h1>
            <p class="lead mb-4">Penerimaan Peserta Didik Baru yang mudah, cepat, dan transparan.</p>

            @auth
                <a href="{{ route('student.dashboard') }}" class="btn btn-primary btn-lg px-5">
                    Daftar Sekarang
                </a>
            @else
              <a href="{{ route('login') }}">Daftar PPDB</a>
            @endauth

        </div>
    </section>

    {{-- INFORMASI HASIL SELEKSI --}}
    <section class="py-5 bg-light border-top border-bottom">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="bg-white shadow-sm rounded-3 p-4">
                    <h5 class="fw-bold text-center mb-3 text-primary">Informasi Hasil Seleksi</h5>
                    
                    <form action="{{ route('front.ppdb.search') }}" method="GET" class="input-group input-group-lg">
                        <input type="text" 
                               name="no_pendaftaran" 
                               class="form-control" 
                               placeholder="Masukkan Nomor Pendaftaran..." 
                               required>
                        <button class="btn btn-success px-4" type="submit">Cari</button>
                    </form>

                    @if (session('error'))
                        <div class="alert alert-danger mt-3 mb-0 text-center">
                            {{ session('error') }}
                        </div>
                    @endif

                    @if (session('success'))
                        <div class="alert alert-success mt-3 mb-0 text-center">
                            {{ session('success') }}
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</section>

<style>
.card:hover {
    transform: translateY(-5px);
    transition: 0.3s ease;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
}

.btn-success {
    background-color: #00b050;
    border: none;
}

.btn-success:hover {
    background-color: #00913f;
}
</style>

@endsection