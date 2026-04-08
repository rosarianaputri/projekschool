@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="mb-1">Nilai</h4>
        <p class="text-muted mb-0">Catat nilai tugas, UTS, UAS, dan pantau rata-rata nilai siswa.</p>
    </div>
    <a href="{{ route('teacher.grades.create') }}" class="btn btn-primary">Tambah Nilai</a>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="card">
    <div class="card-body">
        @if($grades->isEmpty())
            <p class="text-muted">Belum ada nilai. Tambahkan nilai untuk siswa pertama Anda.</p>
        @else
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th>Siswa</th>
                            <th>Kelas</th>
                            <th>Kategori</th>
                            <th>Nilai</th>
                            <th>Catatan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($grades as $grade)
                            <tr>
                                <td>{{ $grade->student_name }}</td>
                                <td>{{ $grade->class->name ?? '-' }}</td>
                                <td>{{ $grade->category ?: '-' }}</td>
                                <td>{{ $grade->score }}</td>
                                <td>{{ $grade->note ?: '-' }}</td>
                                <td>
                                    <a href="{{ route('teacher.grades.edit', $grade) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                                    <form action="{{ route('teacher.grades.destroy', $grade) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Hapus nilai ini?')">Hapus</button>
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
