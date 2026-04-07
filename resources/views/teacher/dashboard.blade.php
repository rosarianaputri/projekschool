@extends('layouts.admin')

@php
    $title = 'LaylaSchool || Dashboard Guru';
    $pageTitle = 'Dashboard Guru';
@endphp

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-3">
                <h5 class="mb-0">Data Siswa PPDB</h5>
                <span class="badge bg-info text-dark">Akses Guru: Data Siswa Saja</span>
            </div>

            <div class="row g-2 mb-3">
                <div class="col-md-3">
                    <div class="p-3 border rounded bg-light-info">
                        <small class="text-muted d-block">Akun Siswa</small>
                        <h5 class="mb-0 text-info">{{ $studentStats['student_accounts'] }}</h5>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="p-3 border rounded bg-light">
                        <small class="text-muted d-block">Total Pendaftar PPDB</small>
                        <h5 class="mb-0">{{ $studentStats['ppdb_total'] }}</h5>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="p-3 border rounded bg-light-warning">
                        <small class="text-muted d-block">Pending</small>
                        <h5 class="mb-0 text-warning">{{ $studentStats['ppdb_pending'] }}</h5>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="p-3 border rounded bg-light-success">
                        <small class="text-muted d-block">Diterima</small>
                        <h5 class="mb-0 text-success">{{ $studentStats['ppdb_approved'] }}</h5>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="p-3 border rounded bg-light-danger">
                        <small class="text-muted d-block">Ditolak</small>
                        <h5 class="mb-0 text-danger">{{ $studentStats['ppdb_rejected'] }}</h5>
                    </div>
                </div>
            </div>

            <div class="row g-2 mb-3">
                <div class="col-md-4">
                    <div class="p-3 border rounded bg-light">
                        <small class="text-muted d-block">Data PPDB (Halaman Ini)</small>
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

            <form method="GET" action="{{ route('teacher.dashboard') }}" class="row g-2 mb-3">
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
                    <a href="{{ route('teacher.dashboard') }}" class="btn btn-outline-secondary">Reset</a>
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
                            <th>Aksi</th>
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
                                    <a href="{{ route('teacher.ppdb.show', $application) }}" class="btn btn-sm btn-primary">Detail</a>
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
                <h5 class="mb-0">Aktivitas Login Siswa Terbaru</h5>
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
                        @forelse ($studentLoginActivities as $activity)
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
                                <td colspan="6" class="text-center text-muted">Belum ada riwayat login siswa.</td>
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
    .bg-light-info {
        background-color: rgba(13, 202, 240, 0.12);
    }

    .bg-light-success {
        background-color: rgba(25, 135, 84, 0.1);
    }

    .bg-light-warning {
        background-color: rgba(255, 193, 7, 0.2);
    }

    .bg-light-danger {
        background-color: rgba(220, 53, 69, 0.12);
    }
</style>
