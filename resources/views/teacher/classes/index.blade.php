@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="mb-1">Kelas Guru</h4>
        <p class="text-muted mb-0">Kelola semua kelas yang Anda ampu dan edit jadwalnya.</p>
    </div>
    <a href="{{ route('teacher.classes.create') }}" class="btn btn-primary">Tambah Kelas</a>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="card">
    <div class="card-body">
        @if($classes->isEmpty())
            <p class="text-muted">Belum ada kelas. Tambahkan kelas baru untuk memulai.</p>
        @else
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th>Nama Kelas</th>
                            <th>Mapel</th>
                            <th>Semester</th>
                            <th>Jadwal</th>
                            <th>Ruang</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($classes as $class)
                            <tr>
                                <td>{{ $class->name }}</td>
                                <td>{{ $class->subject }}</td>
                                <td>{{ $class->semester ?: '-' }}</td>
                                <td>{{ $class->schedule ?: '-' }}</td>
                                <td>{{ $class->room ?: '-' }}</td>
                                <td>
                                    <a href="{{ route('teacher.classes.edit', $class) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                                    <form action="{{ route('teacher.classes.destroy', $class) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Hapus kelas ini?')">Hapus</button>
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
