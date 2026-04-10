@extends('layouts.admin')

@section('content')
<style>
    .classes-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 20px;
        margin-top: 24px;
    }

    .class-summary-card {
        background: white;
        border-radius: 14px;
        box-shadow: 0 2px 12px rgba(0,0,0,0.06);
        overflow: hidden;
        transition: transform .2s, box-shadow .2s;
        border: 1px solid #eef1f5;
        display: flex;
        flex-direction: column;
        height: 100%;
    }

    .class-summary-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.08);
    }

    .class-summary-card-header {
        padding: 18px 20px;
        background: #f8f9ff;
        border-bottom: 1px solid #e8ebf3;
    }

    .class-summary-card-header h5 {
        margin: 0;
        font-size: 16px;
        font-weight: 700;
    }

    .class-summary-card-header small {
        display: block;
        color: #7a7f8c;
        margin-top: 6px;
    }

    .class-summary-card-body {
        padding: 20px;
        flex: 1;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        gap: 10px;
    }

    .class-summary-item {
        font-size: 14px;
        color: #555;
    }

    .class-summary-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 10px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 700;
        color: #fff;
        background: #667eea;
    }

    .student-table-card {
        background: white;
        border-radius: 14px;
        box-shadow: 0 2px 12px rgba(0,0,0,0.06);
        overflow: hidden;
    }

    .student-table-card .table {
        margin-bottom: 0;
    }

    .student-table-card thead {
        background: #f8f9ff;
    }

    .student-table-card tbody tr:hover {
        background-color: #fcfcff;
    }

    .student-number {
        background: #eef2ff;
        width: 32px;
        height: 32px;
        display: inline-flex;
        justify-content: center;
        align-items: center;
        border-radius: 8px;
        color: #4f46e5;
        font-weight: 600;
    }

    .student-label {
        color: #6b7280;
        font-size: 13px;
    }

    .student-actions .btn {
        min-width: 90px;
    }

    .student-info-header {
        margin-bottom: 20px;
        display: flex;
        justify-content: space-between;
        gap: 10px;
        flex-wrap: wrap;
    }

    .student-info-header .info-card {
        background: #f8f9ff;
        padding: 16px 18px;
        border-radius: 12px;
        min-width: 170px;
    }

    .student-info-header .info-card h6 {
        margin: 0 0 6px;
        font-size: 14px;
        color: #111827;
    }

    .student-info-header .info-card span {
        color: #6b7280;
        font-size: 13px;
    }

    .back-link {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 16px;
        border-radius: 10px;
        background: white;
        color: #111827;
        border: 1px solid #e5e7eb;
        transition: all .2s;
        text-decoration: none;
        font-weight: 600;
    }

    .back-link:hover {
        background: #f3f4f6;
    }

    .no-class-selected {
        padding: 40px 20px;
        text-align: center;
        border-radius: 14px;
        background: #fff;
        box-shadow: 0 2px 12px rgba(0,0,0,0.04);
    }

    .no-class-selected h5 {
        margin-bottom: 12px;
    }

    @media (max-width: 768px) {
        .classes-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="mb-1">Data Siswa</h4>
        <p class="text-muted mb-0">Data siswa tampil berdasarkan kelas yang sudah diproses oleh admin, jadi guru tidak perlu melihat mata pelajaran atau jadwal.</p>
    </div>
    <a href="{{ route('teacher.students.create') }}" class="btn btn-primary">Tambah Siswa</a>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if(isset($selectedClass) && $selectedClass)
    <div class="student-info-header">
        <a href="{{ route('teacher.students.index') }}" class="back-link">
            <i class="feather-arrow-left"></i>
            Kembali ke Kelas
        </a>
        <div class="info-card">
            <h6>Kelas</h6>
            <span>{{ $selectedClass->name }}</span>
        </div>
        <div class="info-card">
            <h6>Total Siswa</h6>
            <span>{{ $students->total() }}</span>
        </div>
        <div class="info-card">
            <h6>Status</h6>
            <span>Diproses oleh admin</span>
        </div>
    </div>

    @if($students->isEmpty())
        <div class="no-class-selected">
            <h5>Belum ada siswa di kelas ini</h5>
            <p>Silakan tambahkan siswa ke kelas ini atau pilih kelas lain.</p>
        </div>
    @else
        <div class="student-table-card">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th style="width: 60px;">No</th>
                        <th>Nama</th>
                        <th>NIS</th>
                        <th>No. HP</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($students as $index => $student)
                        <tr>
                            <td>
                                <div class="student-number">{{ $students->firstItem() + $index }}</div>
                            </td>
                            <td>
                                <div class="student-name">{{ $student->name }}</div>
                                <div class="student-label">ID: {{ $student->id }}</div>
                            </td>
                            <td>{{ $student->nis ?: '-' }}</td>
                            <td>{{ $student->phone ?: '-' }}</td>
                            <td>{{ $student->email ?: '-' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="students-table-footer mt-3">
            <div>Menampilkan {{ $students->firstItem() }} sampai {{ $students->lastItem() }} dari {{ $students->total() }} siswa</div>
            <div class="pagination-wrapper">{{ $students->links('pagination::bootstrap-5') }}</div>
        </div>
    @endif
@else
    <div class="classes-grid">
        @foreach($classes as $class)
            <div class="class-summary-card">
                <div class="class-summary-card-header">
                    <h5>{{ $class->name }}</h5>
                </div>
                <div class="class-summary-card-body">
                    <div>
                        <div class="class-summary-item">Siswa: <strong>{{ $class->students_count }}</strong></div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <span class="class-summary-badge">Lihat Siswa</span>
                        <a href="{{ route('teacher.students.class', $class) }}" class="btn btn-sm btn-outline-primary">Buka</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif
@endsection
