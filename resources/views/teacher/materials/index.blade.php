@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="mb-1">Materi</h4>
        <p class="text-muted mb-0">Upload atau simpan link materi pembelajaran untuk kelas.</p>
    </div>
    <a href="{{ route('teacher.materials.create') }}" class="btn btn-primary">Tambah Materi</a>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="card">
    <div class="card-body">
        @if($materials->isEmpty())
            <p class="text-muted">Belum ada materi. Tambahkan materi agar siswa bisa belajar lebih mudah.</p>
        @else
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th>Judul</th>
                            <th>Kelas</th>
                            <th>Jenis</th>
                            <th>Link</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($materials as $material)
                            <tr>
                                <td>{{ $material->title }}</td>
                                <td>{{ $material->class->name ?? '-' }}</td>
                                <td>{{ $material->type ?: '-' }}</td>
                                <td>{{ $material->link ? 'Tersedia' : '-' }}</td>
                                <td>
                                    <a href="{{ route('teacher.materials.edit', $material) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                                    <form action="{{ route('teacher.materials.destroy', $material) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Hapus materi?')">Hapus</button>
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
