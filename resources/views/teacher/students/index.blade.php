@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="mb-1">Data Siswa</h4>
        <p class="text-muted mb-0">Kelola profil siswa, NIS, kontak, dan catatan khusus.</p>
    </div>
    <a href="{{ route('teacher.students.create') }}" class="btn btn-primary">Tambah Siswa</a>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="card">
    <div class="card-body">
        @if($students->isEmpty())
            <p class="text-muted">Belum ada data siswa. Tambahkan siswa baru untuk memulai.</p>
        @else
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>NIS</th>
                            <th>Kelas</th>
                            <th>HP / Email</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($students as $student)
                            <tr>
                                <td>{{ $student->name }}</td>
                                <td>{{ $student->nis ?: '-' }}</td>
                                <td>{{ $student->class->name ?? '-' }}</td>
                                <td>{{ $student->phone ?: '-' }} / {{ $student->email ?: '-' }}</td>
                                <td>
                                    <a href="{{ route('teacher.students.edit', $student) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                                    <form action="{{ route('teacher.students.destroy', $student) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Hapus data siswa?')">Hapus</button>
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
