@extends('layouts.admin')

@php
    $title = 'Data Siswa';
    $pageTitle = 'Data Siswa';
@endphp

@section('content')
<div class="row g-4">
    <div class="col-12">
        <div class="card stretch stretch-full">
            <div class="card-body">
                <div>
                    <h3 class="mb-1">Data Siswa</h3>
                    <p class="text-muted mb-0">Daftar siswa yang sudah tersimpan dari proses administrasi dan pendaftaran.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12">
        <div class="card stretch stretch-full">
            <div class="card-header">
                <div>
                    <h5 class="card-title mb-0">Daftar Siswa</h5>
                    <small class="text-muted">Total: {{ $students->count() }} siswa</small>
                </div>
            </div>

            <div class="card-body">
                @if($students->isEmpty())
                    <div class="text-center py-5">
                        <h5 class="mb-2">Belum ada data siswa</h5>
                        <p class="text-muted mb-0">Data siswa akan muncul setelah proses pendaftaran atau input data dilakukan.</p>
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="ps-3">Nama Siswa</th>
                                    <th>Asal Sekolah</th>
                                    <th>Nama Orang Tua</th>
                                    <th>No HP</th>
                                    <th class="pe-3">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($students as $student)
                                    <tr>
                                        <td class="ps-3">
                                            <div class="fw-semibold text-dark">{{ $student->student_name }}</div>
                                            <small class="text-muted">Calon / data siswa</small>
                                        </td>
                                        <td>{{ $student->previous_school ?: '-' }}</td>
                                        <td>{{ $student->parent_name ?: '-' }}</td>
                                        <td>{{ $student->phone ?: '-' }}</td>
                                        <td class="pe-3">
                                            @php
                                                $status = strtolower($student->status ?? 'pending');
                                                $badge = match($status) {
                                                    'approved', 'acc' => 'success',
                                                    'rejected', 'ditolak' => 'danger',
                                                    default => 'warning',
                                                };
                                            @endphp
                                            <span class="badge bg-{{ $badge }}">
                                                {{ ucfirst($student->status ?? 'Pending') }}
                                            </span>
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
@endsection 