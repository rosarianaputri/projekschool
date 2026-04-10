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
                                    <div class="d-flex gap-2 align-items-center">
                                        <a href="{{ route('teacher.grades.edit', $grade) }}" class="btn btn-sm btn-outline-primary d-flex align-items-center justify-content-center" style="width:38px; height:38px; padding:0;" title="Edit nilai">
                                            <i class="feather-edit-2"></i>
                                            <span class="visually-hidden">Edit</span>
                                        </a>
                                        <form action="{{ route('teacher.grades.destroy', $grade) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger d-flex align-items-center justify-content-center" style="width:38px; height:38px; padding:0;" title="Hapus nilai" onclick="return confirm('Hapus nilai ini?')">
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
                    {{ $grades->links() }}
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
