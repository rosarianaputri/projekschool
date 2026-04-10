@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="mb-1">Tugas</h4>
        <p class="text-muted mb-0">Buat dan pantau tugas serta tenggat waktunya.</p>
    </div>
    <a href="{{ route('teacher.assignments.create') }}" class="btn btn-primary">Tambah Tugas</a>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="card">
    <div class="card-body">
        @if($assignments->isEmpty())
            <p class="text-muted">Belum ada tugas. Tambahkan tugas untuk siswa Anda.</p>
        @else
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th>Judul</th>
                            <th>Kelas</th>
                            <th>Deadline</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($assignments as $assignment)
                            <tr>
                                <td>{{ $assignment->title }}</td>
                                <td>{{ $assignment->class->name ?? '-' }}</td>
                                <td>{{ $assignment->due_date ? $assignment->due_date->format('d M Y') : '-' }}</td>
                                <td>{{ ucfirst($assignment->status) }}</td>
                                <td>
                                    <a href="{{ route('teacher.assignments.edit', $assignment) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                                    <form action="{{ route('teacher.assignments.destroy', $assignment) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Hapus tugas?')">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-center mt-3">
                    {{ $assignments->links() }}
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
