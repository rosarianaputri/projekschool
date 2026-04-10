@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="mb-1">Jadwal</h4>
        <p class="text-muted mb-0">Kelola jadwal kelas agar semua sesi mengajar terorganisir.</p>
    </div>
    <a href="{{ route('teacher.schedule.create') }}" class="btn btn-primary">Tambah Jadwal</a>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="card">
    <div class="card-body">
        @if($schedules->isEmpty())
            <p class="text-muted">Belum ada jadwal. Tambahkan jadwal untuk setiap kelas.</p>
        @else
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th>Hari</th>
                            <th>Waktu</th>
                            <th>Kelas</th>
                            <th>Ruang</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($schedules as $schedule)
                            <tr>
                                <td>{{ $schedule->day }}</td>
                                <td>{{ $schedule->start_time }} - {{ $schedule->end_time }}</td>
                                <td>{{ $schedule->class->name ?? '-' }}</td>
                                <td>{{ $schedule->room ?: '-' }}</td>
                                <td>
                                    <a href="{{ route('teacher.schedule.edit', $schedule) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                                    <form action="{{ route('teacher.schedule.destroy', $schedule) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Hapus jadwal?')">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-center mt-3">
                    {{ $schedules->links() }}
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
