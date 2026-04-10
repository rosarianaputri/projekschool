@extends('layouts.admin')

@section('content')
<style>
    .attendance-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 20px;
        border-radius: 8px;
        margin-bottom: 20px;
    }

    .attendance-header h3 {
        margin: 0 0 5px 0;
        font-size: 28px;
    }

    .attendance-header p {
        margin: 0;
        opacity: 0.9;
        font-size: 14px;
    }

    .attendance-controls {
        background: #f8f9fa;
        padding: 15px;
        border-radius: 8px;
        margin-bottom: 20px;
        display: flex;
        gap: 10px;
        align-items: center;
        flex-wrap: wrap;
    }

    .attendance-controls .btn {
        padding: 8px 16px;
        font-size: 14px;
    }

    .student-attendance-list {
        background: white;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
    }

    .student-attendance-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 12px 16px;
        border-bottom: 1px solid #f0f0f0;
        transition: background 0.2s;
    }

    .student-attendance-item:hover {
        background: #f9f9f9;
    }

    .student-name {
        font-weight: 500;
        color: #333;
        flex: 1;
    }

    .student-number {
        background: #eef2ff;
        color: #667eea;
        width: 32px;
        height: 32px;
        border-radius: 4px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
        font-weight: 600;
        margin-right: 10px;
    }

    .attendance-buttons {
        display: flex;
        gap: 6px;
    }

    .attendance-btn {
        width: 36px;
        height: 36px;
        border: 1px solid #ddd;
        border-radius: 4px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        font-size: 12px;
        font-weight: 600;
        transition: all 0.2s;
    }

    .attendance-btn:hover {
        border-color: #999;
    }

    .attendance-btn.present {
        background: #d4edda;
        color: #155724;
        border-color: #28a745;
    }

    .attendance-btn.permission {
        background: #fff3cd;
        color: #856404;
        border-color: #ffc107;
    }

    .attendance-btn.sick {
        background: #d1ecf1;
        color: #0c5460;
        border-color: #17a2b8;
    }

    .attendance-btn.absent {
        background: #f8d7da;
        color: #721c24;
        border-color: #f5c6cb;
    }

    .attendance-summary {
        background: white;
        padding: 20px;
        border-radius: 8px;
        margin-top: 20px;
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: 15px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
    }

    .summary-card {
        text-align: center;
        padding: 15px;
        border-radius: 6px;
        background: #f8f9fa;
    }

    .summary-card.present {
        background: #d4edda;
        color: #155724;
    }

    .summary-card.permission {
        background: #fff3cd;
        color: #856404;
    }

    .summary-card.sick {
        background: #d1ecf1;
        color: #0c5460;
    }

    .summary-card.absent {
        background: #f8d7da;
        color: #721c24;
    }

    .summary-card h6 {
        margin: 0 0 5px 0;
        font-size: 12px;
        opacity: 0.8;
    }

    .summary-card .count {
        font-size: 24px;
        font-weight: 700;
    }

    .back-link {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 8px 16px;
        margin-bottom: 20px;
        border-radius: 6px;
        background: white;
        color: #333;
        text-decoration: none;
        border: 1px solid #ddd;
        transition: all 0.2s;
    }

    .back-link:hover {
        background: #f5f5f5;
        border-color: #999;
    }

    @media (max-width: 768px) {
        .attendance-controls {
            flex-direction: column;
        }

        .attendance-controls .btn {
            width: 100%;
        }

        .student-attendance-item {
            flex-direction: column;
            align-items: flex-start;
        }

        .attendance-buttons {
            width: 100%;
            margin-top: 10px;
        }

        .attendance-btn {
            flex: 1;
        }
    }
</style>

<a href="{{ route('teacher.classes.index') }}" class="back-link">
    <i class="feather-arrow-left"></i>
    Kembali ke Kelas
</a>

<div class="attendance-header">
    <h3>{{ $teacher_class->name }}</h3>
    <p>Catat kehadiran siswa di kelas ini hari ini</p>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show">
        <i class="feather-check-circle me-2"></i>
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="attendance-controls">
    <input type="date" id="attendanceDate" class="form-control" style="max-width: 200px;" value="{{ now()->toDateString() }}">
    <button type="button" class="btn btn-secondary" onclick="markAllPresent()">Semua Hadir</button>
    <button type="button" class="btn btn-warning" onclick="clearAttendance()">Bersihkan</button>
</div>

<form method="POST" action="{{ route('teacher.attendance.store-by-class', $teacher_class) }}" id="attendanceForm">
    @csrf

    <input type="hidden" name="date" id="dateInput" value="{{ now()->toDateString() }}">

    <div class="student-attendance-list">
        @if($students->isEmpty())
            <div style="padding: 40px; text-align: center; color: #999;">
                <i class="feather-inbox" style="font-size: 48px; margin-bottom: 10px; display: block; color: #ddd;"></i>
                <p>Belum ada siswa di kelas ini</p>
            </div>
        @else
            @foreach($students as $index => $student)
                @php
                    // Realistic attendance distribution: 80% present, 10% permission, 5% sick, 5% absent
                    $rand = rand(1, 100);
                    if ($rand <= 80) {
                        $defaultStatus = 'present';
                    } elseif ($rand <= 90) {
                        $defaultStatus = 'permission';
                    } elseif ($rand <= 95) {
                        $defaultStatus = 'sick';
                    } else {
                        $defaultStatus = 'absent';
                    }
                @endphp
                <div class="student-attendance-item">
                    <div style="display: flex; align-items: center;">
                        <div class="student-number">{{ $students->firstItem() + $index }}</div>
                        <div class="student-name">
                            {{ $student->name }}
                            @if($student->nis)
                                <small style="color: #999;">{{ $student->nis }}</small>
                            @endif
                        </div>
                    </div>
                    <div class="attendance-buttons">
                        <button type="button" class="attendance-btn present {{ $defaultStatus == 'present' ? 'active' : '' }}" data-student="student_{{ $student->id }}" data-status="present" data-name="{{ $student->name }}">
                            ✓ Hadir
                        </button>
                        <button type="button" class="attendance-btn permission {{ $defaultStatus == 'permission' ? 'active' : '' }}" data-student="student_{{ $student->id }}" data-status="permission" data-name="{{ $student->name }}">
                            I Izin
                        </button>
                        <button type="button" class="attendance-btn sick {{ $defaultStatus == 'sick' ? 'active' : '' }}" data-student="student_{{ $student->id }}" data-status="sick" data-name="{{ $student->name }}">
                            S Sakit
                        </button>
                        <button type="button" class="attendance-btn absent {{ $defaultStatus == 'absent' ? 'active' : '' }}" data-student="student_{{ $student->id }}" data-status="absent" data-name="{{ $student->name }}">
                            A Alfa
                        </button>
                    </div>
                    <input type="hidden" name="students[{{ $loop->index }}][id]" value="{{ $student->id }}">
                    <input type="hidden" name="students[{{ $loop->index }}][status]" class="student-status status_{{ $student->id }}" value="{{ $defaultStatus }}">
                </div>
            @endforeach
        @endif
    </div>

    <div class="attendance-summary">
        <div class="summary-card present">
            <h6>Hadir</h6>
            <div class="count" id="countPresent">0</div>
        </div>
        <div class="summary-card permission">
            <h6>Izin</h6>
            <div class="count" id="countPermission">0</div>
        </div>
        <div class="summary-card sick">
            <h6>Sakit</h6>
            <div class="count" id="countSick">0</div>
        </div>
        <div class="summary-card absent">
            <h6>Alfa</h6>
            <div class="count" id="countAbsent">0</div>
        </div>
    </div>

    @if(!$students->isEmpty())
        <div style="margin-top: 20px; display: flex; gap: 10px;">
            <button type="submit" class="btn btn-primary btn-lg">
                <i class="feather-save me-2"></i>
                Simpan Absensi
            </button>
            <a href="{{ route('teacher.attendance.index') }}" class="btn btn-outline-secondary btn-lg">
                <i class="feather-arrow-left me-2"></i>
                Kembali
            </a>
        </div>
    @endif
</form>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const attendanceButtons = document.querySelectorAll('.attendance-btn');

    attendanceButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();

            const studentId = this.dataset.student;
            const status = this.dataset.status;
            const statusField = document.querySelector(`.${studentId}.student-status`);

            if (statusField) {
                statusField.value = status;
            }

            const parentItem = this.closest('.student-attendance-item');
            const buttons = parentItem.querySelectorAll('.attendance-btn');

            buttons.forEach(btn => {
                btn.style.opacity = '0.5';
            });

            this.style.opacity = '1';

            updateSummary();
        });
    });

    const dateInput = document.getElementById('attendanceDate');
    dateInput.addEventListener('change', function() {
        document.getElementById('dateInput').value = this.value;
    });

    function updateSummary() {
        let counts = {
            present: 0,
            permission: 0,
            sick: 0,
            absent: 0
        };

        document.querySelectorAll('.student-status').forEach(field => {
            const status = field.value;
            if (counts.hasOwnProperty(status)) {
                counts[status]++;
            }
        });

        document.getElementById('countPresent').textContent = counts.present;
        document.getElementById('countPermission').textContent = counts.permission;
        document.getElementById('countSick').textContent = counts.sick;
        document.getElementById('countAbsent').textContent = counts.absent;
    }

    window.markAllPresent = function() {
        document.querySelectorAll('.student-status').forEach(field => {
            field.value = 'present';
        });

        document.querySelectorAll('.attendance-btn').forEach(btn => {
            btn.style.opacity = '0.5';
        });

        document.querySelectorAll('.attendance-btn.present').forEach(btn => {
            btn.style.opacity = '1';
        });

        updateSummary();
    };

    window.clearAttendance = function() {
        if (confirm('Bersihkan semua absensi?')) {
            document.querySelectorAll('.student-status').forEach(field => {
                field.value = 'present';
            });

            document.querySelectorAll('.attendance-btn').forEach(btn => {
                btn.style.opacity = '0.5';
            });

            document.querySelectorAll('.attendance-btn.present').forEach(btn => {
                btn.style.opacity = '1';
            });

            updateSummary();
        }
    };

    // Initialize button states based on default status
    document.querySelectorAll('.student-attendance-item').forEach(item => {
        const statusField = item.querySelector('.student-status');
        const status = statusField.value;
        const buttons = item.querySelectorAll('.attendance-btn');

        buttons.forEach(btn => {
            if (btn.dataset.status === status) {
                btn.style.opacity = '1';
            } else {
                btn.style.opacity = '0.5';
            }
        });
    });

    updateSummary();
});
</script>

@endsection
