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
                                    <div class="d-flex gap-2 align-items-center">
                                        <a href="{{ route('teacher.attendance.edit', $attendance) }}" class="btn btn-sm btn-outline-primary d-flex align-items-center justify-content-center" style="width:38px; height:38px; padding:0;" title="Edit absensi">
                                            <i class="feather-edit-2"></i>
                                            <span class="visually-hidden">Edit</span>
                                        </a>
                                        <form action="{{ route('teacher.attendance.destroy', $attendance) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger d-flex align-items-center justify-content-center" style="width:38px; height:38px; padding:0;" title="Hapus absensi" onclick="return confirm('Hapus data absensi?')">
                                                <i class="feather-trash-2"></i>
                                                <span class="visually-hidden">Hapus</span>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-center mt-3">
                    {{ $attendances->links() }}
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
