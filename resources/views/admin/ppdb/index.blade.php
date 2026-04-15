@extends('layouts.admin')

@php
    $title = 'Data PPDB';
    $pageTitle = 'Data PPDB';
@endphp

@section('content')
<div class="row g-4">

    <div class="col-12">
        <div class="card stretch stretch-full">
            <div class="card-body">
                <div>
                    <h3 class="mb-1">Manajemen PPDB</h3>
                    <p class="text-muted mb-0">Tinjau pendaftaran siswa, verifikasi status, lalu tempatkan ke kelas yang sesuai.</p>
                </div>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="col-12">
            <div class="alert alert-success border-0 shadow-sm mb-0">
                {{ session('success') }}
            </div>
        </div>
    @endif

    <div class="col-12">
        <div class="card stretch stretch-full">
            <div class="card-header">
                <div>
                    <h5 class="card-title mb-0">Daftar Pendaftaran</h5>
                    <small class="text-muted">Total: {{ $applications->total() }} pendaftar</small>
                </div>
            </div>

            <div class="card-body">
                @if($applications->isEmpty())
                    <div class="text-center py-5">
                        <h5 class="mb-2">Belum ada data PPDB</h5>
                        <p class="text-muted mb-0">Data pendaftaran siswa akan muncul di halaman ini.</p>
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="ps-3">Nama</th>
                                    <th>Email</th>
                                    <th>No HP</th>
                                    <th>Status</th>
                                    <th class="text-end pe-3">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($applications as $application)
                                    <tr>
                                        <td class="ps-3">
                                            <div class="fw-semibold text-dark">{{ $application->student_name }}</div>
                                            <small class="text-muted">Pendaftar PPDB</small>
                                        </td>
                                        <td>{{ $application->email ?: '-' }}</td>
                                        <td>{{ $application->phone ?: '-' }}</td>
                                        <td>
                                            @php
                                                $status = strtolower($application->status ?? 'pending');
                                                $badge = match($status) {
                                                    'approved' => 'success',
                                                    'rejected' => 'danger',
                                                    default => 'warning text-dark',
                                                };
                                            @endphp

                                            <span class="badge bg-{{ $badge }}">
                                                {{ ucfirst($application->status ?? 'pending') }}
                                            </span>
                                        </td>
                                        <td class="text-end pe-3">
                                            <a href="{{ route('admin.ppdb.show', $application) }}" class="btn btn-sm btn-outline-primary">
                                                Detail
                                            </a>

                                            <form action="{{ route('admin.ppdb.destroy', $application) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus data pendaftar ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                                    Hapus
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-center mt-4">
                        {{ $applications->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>

</div>
@endsection