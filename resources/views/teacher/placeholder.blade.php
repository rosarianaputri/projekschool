@extends('layouts.admin')

@section('title', $pageTitle ?? 'Guru')

@section('content')
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-semibold text-slate-800">{{ $pageTitle }}</h1>
            <p class="text-sm text-slate-500 mt-1">{{ $description ?? 'Halaman ini sedang dikembangkan.' }}</p>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm p-6">
        <p class="text-slate-700 leading-relaxed">
            Halaman ini sudah tersedia dan dapat digunakan sebagai titik awal untuk fitur guru.
            Silakan kembangkan konten dan fungsi sesuai kebutuhan.
        </p>

        <div class="mt-6 grid gap-4 sm:grid-cols-2 xl:grid-cols-3">
            <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
                <h2 class="font-semibold text-slate-900">Langkah berikutnya</h2>
                <ul class="mt-3 space-y-2 text-sm text-slate-600">
                    <li>- Tambahkan data / tabel sesuai fitur.</li>
                    <li>- Sambungkan ke controller / model jika perlu.</li>
                    <li>- Gunakan kembali layout dashboard guru.</li>
                </ul>
            </div>
            <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
                <h2 class="font-semibold text-slate-900">Rute saat ini</h2>
                <p class="mt-2 text-sm text-slate-600">Gunakan menu di dashboard guru untuk mengakses fitur ini.</p>
            </div>
        </div>
    </div>
@endsection
