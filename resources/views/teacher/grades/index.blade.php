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

<div class="row g-4">
    @if($classes->isEmpty())
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <p class="text-muted mb-0">Belum ada kelas atau nilai. Tambahkan kelas dan mulai input nilai per kelas.</p>
                </div>
            </div>
        </div>
    @else
        @foreach($classes as $class)
            <div class="col-lg-6">
                <div class="card h-100">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="mb-1">{{ $class->name }}</h5>
                            <small class="text-muted">{{ $class->subject }} • {{ $class->grades->count() }} nilai</small>
                        </div>
                        <div class="d-flex gap-2 align-items-center">
                            <a href="{{ route('teacher.grades.create', ['class' => $class->id]) }}" class="btn btn-sm btn-primary">Tambah Nilai</a>
                            <button class="btn btn-sm btn-outline-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#classGrades-{{ $class->id }}" aria-expanded="false" aria-controls="classGrades-{{ $class->id }}">
                                Lihat Nilai
                            </button>
                        </div>
                    </div>
                    <div class="collapse" id="classGrades-{{ $class->id }}">
                        <div class="card-body border-top">
                            @if($class->grades->isEmpty())
                                <p class="text-muted mb-0">Belum ada nilai di kelas ini.</p>
                            @else
                                <div class="table-responsive">
                                    <table class="table table-borderless align-middle mb-0">
                                        <thead>
                                            <tr>
                                                <th>Siswa</th>
                                                <th>Kategori</th>
                                                <th>Nilai</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($class->grades as $grade)
                                                <tr>
                                                    <td>{{ $grade->student_name }}</td>
                                                    <td>{{ $grade->category ?: '-' }}</td>
                                                    <td>{{ $grade->score }}</td>
                                                    <td>
                                                        <div class="d-flex gap-2 align-items-center">
                                                            <a href="{{ route('teacher.grades.edit', $grade) }}" class="btn btn-sm btn-outline-primary d-flex align-items-center justify-content-center" style="width:36px; height:36px; padding:0;" title="Edit nilai">
                                                                <i class="feather-edit-2"></i>
                                                            </a>
                                                            <form action="{{ route('teacher.grades.destroy', $grade) }}" method="POST" class="d-inline">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-sm btn-outline-danger d-flex align-items-center justify-content-center" style="width:36px; height:36px; padding:0;" title="Hapus nilai" onclick="return confirm('Hapus nilai ini?')">
                                                                    <i class="feather-trash-2"></i>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
</div>
@endsection
