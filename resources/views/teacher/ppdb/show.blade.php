@extends('layouts.admin')

@php
    $title = 'LaylaSchool || Detail PPDB Siswa';
    $pageTitle = 'Detail PPDB Siswa';
@endphp

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="mb-0">{{ $application->registration_code }}</h5>
                <a href="{{ route('teacher.dashboard') }}" class="btn btn-outline-secondary btn-sm">Kembali</a>
            </div>

            <div class="alert {{ $documentSummary['is_complete'] ? 'alert-success' : 'alert-warning' }} mb-3" role="alert">
                Kelengkapan berkas: {{ $documentSummary['uploaded_required'] }}/{{ $documentSummary['required_total'] }} dokumen wajib
            </div>

            <div class="row g-3">
                <div class="col-md-6"><strong>Nama Siswa:</strong><br>{{ $application->student_name }}</div>
                <div class="col-md-6"><strong>Jenis Kelamin:</strong><br>{{ $application->gender === 'L' ? 'Laki-laki' : 'Perempuan' }}</div>
                <div class="col-md-6"><strong>Tempat, Tanggal Lahir:</strong><br>{{ $application->birth_place }}, {{ $application->birth_date?->format('d-m-Y') }}</div>
                <div class="col-md-6"><strong>Asal Sekolah:</strong><br>{{ $application->previous_school ?: '-' }}</div>
                <div class="col-md-6"><strong>Nama Orang Tua/Wali:</strong><br>{{ $application->parent_name }}</div>
                <div class="col-md-6"><strong>No. HP:</strong><br>{{ $application->phone }}</div>
                <div class="col-md-6"><strong>Email:</strong><br>{{ $application->email }}</div>
                <div class="col-md-6"><strong>Status:</strong><br>
                    @if ($application->status === 'approved')
                        <span class="badge bg-success">ACC</span>
                    @elseif ($application->status === 'rejected')
                        <span class="badge bg-danger">Ditolak</span>
                    @else
                        <span class="badge bg-warning text-dark">Pending</span>
                    @endif
                </div>
                <div class="col-12"><strong>Alamat:</strong><br>{{ $application->address }}</div>
                <div class="col-12"><strong>Catatan:</strong><br>{{ $application->notes ?: '-' }}</div>
            </div>

            <hr class="my-4">

            <h6 class="mb-3">Dokumen Siswa</h6>
            <div class="table-responsive">
                <table class="table table-bordered align-middle">
                    <thead>
                        <tr>
                            <th>Jenis Dokumen</th>
                            <th>Status</th>
                            <th>Nama File</th>
                            <th>Ukuran</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($documentLabels as $type => $label)
                            @php
                                $document = $application->documents->firstWhere('document_type', $type);
                            @endphp
                            <tr>
                                <td>{{ $label }}</td>
                                <td>
                                    @if ($document)
                                        <span class="badge bg-success">Sudah upload</span>
                                    @else
                                        <span class="badge bg-warning text-dark">Belum upload</span>
                                    @endif
                                </td>
                                <td>{{ $document?->original_name ?? '-' }}</td>
                                <td>
                                    @if ($document)
                                        {{ number_format(((int) $document->file_size) / 1024, 2) }} KB
                                    @else
                                        -
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
