@extends('layouts.admin')

@php
    $title = 'LaylaSchool || Dashboard PPDB';
    $pageTitle = 'Dashboard PPDB';
@endphp

@section('content')
    <div class="card">
        <div class="card-body">
            @if (session('status') === 'ppdb_created')
                <div class="alert alert-success">Data pendaftar berhasil ditambahkan.</div>
            @elseif (session('status') === 'ppdb_updated')
                <div class="alert alert-success">Data pendaftar berhasil diperbarui.</div>
            @elseif (session('status') === 'ppdb_deleted')
                <div class="alert alert-danger">Data pendaftar berhasil dihapus.</div>
            @elseif (session('status') === 'ppdb_rejected')
                <div class="alert alert-warning">Pendaftar berhasil ditolak.</div>
            @endif

            @if (session('status') === 'ppdb_approved')
                <div class="alert alert-success">Pendaftar berhasil di-ACC.</div>
            @endif

            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-3">
                <h5 class="mb-0">Penerimaan Siswa Baru (PPDB)</h5>
                <a href="{{ route('admin.ppdb.create') }}" class="btn btn-primary btn-sm">Tambah Pendaftar</a>
            </div>

            <div class="row g-2 mb-3">
                <div class="col-md-3">
                    <div class="p-3 border rounded bg-light">
                        <small class="text-muted d-block">Total User</small>
                        <h5 class="mb-0">{{ $userRoleStats['total'] }}</h5>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="p-3 border rounded bg-light-primary">
                        <small class="text-muted d-block">Admin</small>
                        <h5 class="mb-0 text-primary">{{ $userRoleStats['admin'] }}</h5>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="p-3 border rounded bg-light-info">
                        <small class="text-muted d-block">Guru</small>
                        <h5 class="mb-0 text-info">{{ $userRoleStats['teacher'] }}</h5>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="p-3 border rounded bg-light-success">
                        <small class="text-muted d-block">Siswa</small>
                        <h5 class="mb-0 text-success">{{ $userRoleStats['student'] }}</h5>
                    </div>
                </div>
            </div>

            <div class="row g-2 mb-3">
                <div class="col-md-4">
                    <div class="p-3 border rounded bg-light">
                        <small class="text-muted d-block">Total Pendaftar (Halaman Ini)</small>
                        <h5 class="mb-0">{{ $documentCompletionStats['total'] }}</h5>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-3 border rounded bg-light-success">
                        <small class="text-muted d-block">Dokumen Lengkap</small>
                        <h5 class="mb-0 text-success">{{ $documentCompletionStats['complete'] }}</h5>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-3 border rounded bg-light-warning">
                        <small class="text-muted d-block">Dokumen Belum Lengkap</small>
                        <h5 class="mb-0 text-warning">{{ $documentCompletionStats['incomplete'] }}</h5>
                    </div>
                </div>
            </div>

            <form method="GET" action="{{ route('admin.ppdb.index') }}" class="row g-2 mb-3">
                <div class="col-md-5">
                    <input type="text" class="form-control" name="search" value="{{ $search }}" placeholder="Cari kode, nama siswa, orang tua, no HP">
                </div>
                <div class="col-md-3">
                    <select name="status" class="form-control">
                        <option value="">Semua Status</option>
                        <option value="pending" {{ $status === 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="approved" {{ $status === 'approved' ? 'selected' : '' }}>ACC</option>
                        <option value="rejected" {{ $status === 'rejected' ? 'selected' : '' }}>Ditolak</option>
                    </select>
                </div>
                <div class="col-md-4 d-flex gap-2">
                    <button type="submit" class="btn btn-outline-primary">Filter</button>
                    <a href="{{ route('admin.ppdb.index') }}" class="btn btn-outline-secondary">Reset</a>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-bordered align-middle">
                    <thead>
                        <tr>
                            <th>Kode</th>
                            <th>Nama Siswa</th>
                            <th>Orang Tua</th>
                            <th>No. HP</th>
                            <th>Kelengkapan Berkas</th>
                            <th>Status</th>
                            <th width="320">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($applications as $application)
                            <tr>
                                <td>{{ $application->registration_code }}</td>
                                <td>{{ $application->student_name }}</td>
                                <td>{{ $application->parent_name }}</td>
                                <td>{{ $application->phone }}</td>
                                <td>
                                    @php
                                        $docSummary = $application->document_summary;
                                    @endphp
                                    @if ($docSummary['is_complete'])
                                        <span class="badge bg-success">Lengkap ({{ $docSummary['uploaded_required'] }}/{{ $docSummary['required_total'] }})</span>
                                    @else
                                        <span class="badge bg-warning text-dark">Belum ({{ $docSummary['uploaded_required'] }}/{{ $docSummary['required_total'] }})</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($application->status === 'approved')
                                        <span class="badge bg-success">ACC</span>
                                    @elseif ($application->status === 'rejected')
                                        <span class="badge bg-danger">Ditolak</span>
                                    @else
                                        <span class="badge bg-warning text-dark">Pending</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex flex-wrap gap-2 align-items-center">
                                    <a href="{{ route('admin.ppdb.show', $application) }}" class="btn btn-sm btn-primary px-3">Detail</a>
                                    <a href="{{ route('admin.ppdb.edit', $application) }}" class="btn btn-sm btn-info text-white px-3">Edit</a>
                                    @if ($application->status !== 'approved')
                                        <form method="POST" action="{{ route('admin.ppdb.acc', $application) }}" class="m-0">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-sm btn-success px-3">ACC</button>
                                        </form>
                                    @endif
                                    @if ($application->status !== 'rejected')
                                        <form method="POST" action="{{ route('admin.ppdb.reject', $application) }}" class="m-0">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-sm btn-warning px-3">Tolak</button>
                                        </form>
                                    @endif
                                    <form method="POST" action="{{ route('admin.ppdb.destroy', $application) }}" class="m-0" onsubmit="return confirm('Hapus data pendaftar ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger px-3">Hapus</button>
                                    </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted">Belum ada data pendaftaran PPDB.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{ $applications->links() }}

            <hr class="my-4">

            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-3">
                <h5 class="mb-0">Aktivitas Login Terbaru</h5>
                <small class="text-muted">Auto refresh tiap 30 detik</small>
            </div>

            <div class="table-responsive">
                <table class="table table-sm table-bordered align-middle">
                    <thead>
                        <tr>
                            <th>Waktu Login</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>IP</th>
                            <th>Perangkat</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($loginActivities as $activity)
                            <tr>
                                <td>{{ optional($activity->logged_in_at)->format('d M Y H:i:s') ?? '-' }}</td>
                                <td>{{ $activity->name }}</td>
                                <td>{{ $activity->email }}</td>
                                <td>
                                    <span class="badge bg-secondary text-uppercase">{{ $activity->role }}</span>
                                </td>
                                <td>{{ $activity->ip_address ?? '-' }}</td>
                                <td>{{ \Illuminate\Support\Str::limit((string) $activity->user_agent, 70) }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted">Belum ada riwayat login.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        setTimeout(function () {
            window.location.reload();
        }, 30000);
    </script>
@endpush

<style>
    .bg-light-primary {
        background-color: rgba(13, 110, 253, 0.12);
    }

    .bg-light-info {
        background-color: rgba(13, 202, 240, 0.12);
    }

    .bg-light-success {
        background-color: rgba(25, 135, 84, 0.1);
    }

    .bg-light-warning {
        background-color: rgba(255, 193, 7, 0.2);
    }
</style>
