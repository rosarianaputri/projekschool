@extends('layouts.admin')

@php
    $title = 'Approval Akun Siswa';
    $pageTitle = 'Approval Akun Siswa';
@endphp

@section('content')
<div class="row g-4">

    <div class="col-12">
        <div class="card stretch stretch-full">
            <div class="card-body">
                <div>
                    <h3 class="mb-1">Validasi Akun Siswa</h3>
                    <p class="text-muted mb-0">Tinjau akun siswa yang mendaftar lalu approve atau reject agar akses lebih aman.</p>
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

    @if(session('error'))
        <div class="col-12">
            <div class="alert alert-danger border-0 shadow-sm mb-0">
                {{ session('error') }}
            </div>
        </div>
    @endif

    <div class="col-12">
        <div class="card stretch stretch-full">
            <div class="card-header">
                <div>
                    <h5 class="card-title mb-0">Daftar Akun Siswa</h5>
                    <small class="text-muted">Total: {{ $students->total() }} akun</small>
                </div>
            </div>

            <div class="card-body">
                @if($students->isEmpty())
                    <div class="text-center py-5">
                        <h5 class="mb-2">Belum ada akun siswa</h5>
                        <p class="text-muted mb-0">Akun siswa yang mendaftar akan tampil di halaman ini.</p>
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="ps-3">Nama</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                    <th class="text-end pe-3">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($students as $student)
                                    <tr>
                                        <td class="ps-3">
                                            <div class="fw-semibold text-dark">{{ $student->name }}</div>
                                            <small class="text-muted">Akun siswa terdaftar</small>
                                        </td>
                                        <td>{{ $student->email }}</td>
                                        <td>
                                            <span class="badge bg-soft-primary text-primary">
                                                {{ ucfirst($student->role) }}
                                            </span>
                                        </td>
                                        <td>
                                            @php
                                                $status = strtolower((string) $student->status);
                                                $badge = match($status) {
                                                    'approved' => 'success',
                                                    'rejected' => 'danger',
                                                    default => 'warning',
                                                };
                                            @endphp

                                            <span class="badge bg-{{ $badge }}">
                                                {{ ucfirst($student->status) }}
                                            </span>
                                        </td>
                                        <td class="text-end pe-3">
                                            <form action="{{ route('admin.student-approvals.update', $student) }}" method="POST" class="d-inline-flex gap-2">
                                                @csrf
                                                @method('PUT')

                                                <select name="status" class="form-select form-select-sm" style="min-width: 140px;">
                                                    <option value="pending" {{ $student->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                                    <option value="approved" {{ $student->status === 'approved' ? 'selected' : '' }}>Approved</option>
                                                    <option value="rejected" {{ $student->status === 'rejected' ? 'selected' : '' }}>Rejected</option>
                                                </select>

                                                <button type="submit" class="btn btn-sm btn-primary">
                                                    Simpan
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-center mt-4">
                        {{ $students->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>

</div>
@endsection