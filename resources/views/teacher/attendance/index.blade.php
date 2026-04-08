@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="mb-1">Absensi</h4>
        <p class="text-muted mb-0">Catat kehadiran harian siswa per kelas dan lihat rekap modern.</p>
    </div>
    <a href="{{ route('teacher.attendance.create') }}" class="btn btn-primary">Tambah Absensi</a>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="card">
    <div class="card-body">
        @if($attendances->isEmpty())
            <p class="text-muted">Belum ada catatan absensi. Tambahkan data absensi untuk hari ini.</p>
        @else
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Kelas</th>
                            <th>Hadir</th>
                            <th>Izin</th>
                            <th>Sakit</th>
                            <th>Alfa</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($attendances as $attendance)
                            <tr>
                                <td>{{ $attendance->date->format('d M Y') }}</td>
                                <td>{{ $attendance->class->name ?? '-' }}</td>
                                <td>{{ $attendance->present }}</td>
                                <td>{{ $attendance->permission }}</td>
                                <td>{{ $attendance->sick }}</td>
                                <td>{{ $attendance->absent }}</td>
                                <td>
                                    <a href="{{ route('teacher.attendance.edit', $attendance) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                                    <form action="{{ route('teacher.attendance.destroy', $attendance) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Hapus data absensi?')">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>
@endsection
