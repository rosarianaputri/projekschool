@extends('layouts.admin')

@section('content')
<style>
    .student-list-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        flex-wrap: wrap;
        gap: 10px;
    }

    .class-info {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 20px;
        border-radius: 8px;
        flex: 1;
        min-width: 300px;
    }

    .class-info h3 {
        margin: 0 0 5px 0;
        font-size: 28px;
    }

    .class-info p {
        margin: 0;
        font-size: 14px;
        opacity: 0.9;
    }

    .student-stats {
        display: flex;
        gap: 15px;
        margin-top: 10px;
    }

    .stat-item {
        background: rgba(255, 255, 255, 0.2);
        padding: 8px 12px;
        border-radius: 4px;
        font-size: 12px;
    }

    .semester-badge {
        background: rgba(255, 255, 255, 0.3);
        padding: 4px 8px;
        border-radius: 4px;
        font-size: 11px;
        display: inline-block;
    }

    .students-table {
        background: white;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
    }

    .students-table table {
        margin-bottom: 0;
    }

    .students-table tbody tr {
        border-bottom: 1px solid #f0f0f0;
        transition: background-color 0.2s;
    }

    .students-table tbody tr:hover {
        background-color: #f9f9f9;
    }

    .students-table-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 10px;
        padding: 18px 20px;
        border-top: 1px solid #e9ecef;
        background: #fafbfc;
        font-size: 14px;
        color: #555;
    }

    .pagination-wrapper {
        display: flex;
        justify-content: flex-end;
        padding: 0 20px 20px;
    }

    .pagination .page-link {
        border-radius: 6px;
        padding: 8px 12px;
    }

    .pagination .page-item.active .page-link {
        background-color: #667eea;
        border-color: #667eea;
        color: #fff;
    }

    .pagination .page-link:hover {
        background-color: #f3f4ff;
    }

    .student-name {
        font-weight: 500;
        color: #333;
    }

    .student-nis {
        color: #666;
        font-size: 13px;
    }

    .student-contact {
        font-size: 13px;
        color: #666;
    }

    .student-number {
        background: #f0f0f0;
        width: 32px;
        height: 32px;
        border-radius: 4px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        color: #667eea;
        font-size: 12px;
    }

    .back-btn {
        background: white;
        border: 1px solid #ddd;
        padding: 10px 16px;
        border-radius: 6px;
        text-decoration: none;
        color: #333;
        font-weight: 500;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: all 0.2s;
    }

    .back-btn:hover {
        background: #f5f5f5;
        border-color: #999;
    }

    .empty-students {
        text-align: center;
        padding: 60px 20px;
        color: #999;
    }

    .empty-students-icon {
        font-size: 48px;
        color: #ddd;
        margin-bottom: 10px;
    }

    .students-export {
        display: flex;
        gap: 8px;
    }

    .students-export .btn {
        padding: 8px 12px;
        font-size: 13px;
    }

    @media (max-width: 768px) {
        .student-list-header {
            flex-direction: column;
        }

        .class-info {
            min-width: 100%;
        }

        .students-table {
            font-size: 12px;
        }

        .students-table th,
        .students-table td {
            padding: 10px 8px;
        }
    }
</style>

<div class="student-list-header">
    <a href="{{ route('teacher.classes.index') }}" class="back-btn">
        <i class="feather-arrow-left"></i>
        Kembali ke Kelas
    </a>
</div>

<div class="class-info">
    @php
        $gradeClass = 'grade-10';
        $className = strtoupper($teacher_class->name);
        
        if (strpos($className, 'XII') !== false || strpos($className, '12') !== false) {
            $gradeClass = 'grade-12';
            $gradeLabel = 'Kelas XII';
            $gradeBadgeColor = '#6f42c1';
        } elseif (strpos($className, 'XI') !== false || strpos($className, '11') !== false) {
            $gradeClass = 'grade-11';
            $gradeLabel = 'Kelas XI';
            $gradeBadgeColor = '#28a745';
        } else {
            $gradeClass = 'grade-10';
            $gradeLabel = 'Kelas X';
            $gradeBadgeColor = '#007bff';
        }
    @endphp

    <div style="display: flex; justify-content: space-between; align-items: flex-start;">
        <div>
            <h3>{{ $teacher_class->name }}</h3>
            <p>Data siswa pada kelas ini sudah diproses oleh admin. Guru cukup melihat daftar siswa berdasarkan kelas.</p>
            <div class="student-stats">
                <div class="stat-item">
                    <i class="feather-users me-1"></i>
                    {{ $students->total() }} Siswa
                </div>
                <div class="stat-item">
                    <i class="feather-check-circle me-1"></i>
                    Diproses oleh admin
                </div>
            </div>
        </div>
        <div style="text-align: right;">
            <div class="semester-badge" style="background: rgba(255, 255, 255, 0.5); display: inline-block; padding: 8px 12px; border-radius: 6px; font-weight: 600; font-size: 16px;">
                @if($gradeClass === 'grade-10') 10 @elseif($gradeClass === 'grade-11') 11 @else 12 @endif
            </div>
        </div>
    </div>
</div>

@if($students->isEmpty())
    <div class="empty-students">
        <div class="empty-students-icon">
            <i class="feather-inbox"></i>
        </div>
        <h5>Belum ada data siswa</h5>
        <p>Tambahkan siswa ke kelas ini untuk melihat daftar siswa.</p>
    </div>
@else
    <div class="students-table">
        <table class="table align-middle table-hover mb-0">
            <thead style="background-color: #f8f9fa; border-bottom: 2px solid #e9ecef;">
                <tr>
                    <th style="width: 50px;">No</th>
                    <th>Nama Siswa</th>
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
                            <div class="student-nis">ID: {{ $student->id }}</div>
                        </td>
                        <td>
                            <span class="student-nis">{{ $student->nis ?: '-' }}</span>
                        </td>
                        <td>
                            <span class="student-contact">{{ $student->phone ?: '-' }}</span>
                        </td>
                        <td>
                            <span class="student-contact" style="word-break: break-all;">{{ $student->email ?: '-' }}</span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="students-table-footer">
        <div>
            Menampilkan <strong>{{ $students->firstItem() }}</strong> sampai <strong>{{ $students->lastItem() }}</strong> dari <strong>{{ $students->total() }}</strong> siswa
        </div>
        @if($students->hasPages())
            <div class="pagination-wrapper">
                {{ $students->links('pagination::bootstrap-5') }}
            </div>
        @endif
    </div>
@endif

@endsection
