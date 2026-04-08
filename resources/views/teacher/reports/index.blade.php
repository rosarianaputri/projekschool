@extends('layouts.admin')

@section('content')
<div class="mb-4">
    <h4>Ringkasan & Laporan Guru</h4>
    <p class="text-muted">Lihat statistik yang membantu Anda memantau kelas, siswa, tugas, dan hasil ajar.</p>
</div>

<div class="row g-3">
    <div class="col-md-4">
        <div class="card p-3">
            <h6>Kelas</h6>
            <h2 class="mb-0">{{ $summary['classes'] }}</h2>
            <p class="text-muted mb-0">Jumlah kelas yang dikelola.</p>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card p-3">
            <h6>Siswa</h6>
            <h2 class="mb-0">{{ $summary['students'] }}</h2>
            <p class="text-muted mb-0">Data siswa yang tercatat.</p>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card p-3">
            <h6>Tugas</h6>
            <h2 class="mb-0">{{ $summary['assignments'] }}</h2>
            <p class="text-muted mb-0">Total tugas terdaftar.</p>
        </div>
    </div>
</div>

<div class="row g-3 mt-3">
    <div class="col-md-4">
        <div class="card p-3">
            <h6>Materi</h6>
            <h2 class="mb-0">{{ $summary['materials'] }}</h2>
            <p class="text-muted mb-0">Sumber belajar yang sudah dibuat.</p>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card p-3">
            <h6>Nilai</h6>
            <h2 class="mb-0">{{ $summary['grades'] }}</h2>
            <p class="text-muted mb-0">Jumlah catatan nilai tersimpan.</p>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card p-3">
            <h6>Absensi</h6>
            <h2 class="mb-0">{{ $summary['attendance_records'] }}</h2>
            <p class="text-muted mb-0">Rekap absensi yang dicatat.</p>
        </div>
    </div>
</div>

<div class="card mt-4">
    <div class="card-header">
        <h5 class="card-title mb-0">Kelas Teratas</h5>
    </div>
    <div class="card-body">
        @if($topClasses->isEmpty())
            <p class="text-muted">Tambahkan kelas agar statistik bisa muncul di sini.</p>
        @else
            <div class="list-group">
                @foreach($topClasses as $class)
                    <div class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <strong>{{ $class->name }}</strong>
                            <div class="text-muted small">{{ $class->subject }}</div>
                        </div>
                        <span class="badge bg-primary">{{ $class->schedule ?: 'Jadwal belum diisi' }}</span>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
@endsection
