@extends('layouts.admin')

@section('content')
<style>
    .class-card {
        background: #fff;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        height: 100%;
        display: flex;
        flex-direction: column;
        position: relative;
        border: 3px solid transparent;
    }

    .class-card:hover {
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.12);
        transform: translateY(-4px);
    }

    /* Tingkat 10 - Border Biru */
    .class-card.grade-10 {
        border-color: #007bff;
    }

    .class-card.grade-10 .class-card-header::before {
        background: linear-gradient(135deg, rgba(0, 123, 255, 0.1) 0%, rgba(0, 123, 255, 0.05) 100%);
    }

    /* Tingkat 11 - Border Hijau */
    .class-card.grade-11 {
        border-color: #28a745;
    }

    .class-card.grade-11 .class-card-header::before {
        background: linear-gradient(135deg, rgba(40, 167, 69, 0.1) 0%, rgba(40, 167, 69, 0.05) 100%);
    }

    /* Grade badges */
    .grade-badge {
        position: absolute;
        top: 12px;
        left: 12px;
        background: rgba(255, 255, 255, 0.9);
        color: #333;
        padding: 4px 8px;
        border-radius: 12px;
        font-size: 11px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .grade-badge.grade-10 {
        background: rgba(0, 123, 255, 0.9);
        color: white;
    }

    .grade-badge.grade-11 {
        background: rgba(40, 167, 69, 0.9);
        color: white;
    }

    .grade-badge.grade-12 {
        background: rgba(111, 66, 193, 0.9);
        color: white;
    }

    /* Grade sections */
    .grade-section {
        border: 1px solid #e9ecef;
        border-radius: 8px;
        padding: 20px;
        background: #f8f9fa;
    }

    .grade-header {
        border-bottom: 2px solid;
        padding-bottom: 10px;
    }

    .grade-title {
        margin: 0;
        font-size: 18px;
        font-weight: 600;
        display: flex;
        align-items: center;
    }

    .grade-title.grade-10 {
        color: #007bff;
        border-bottom-color: #007bff;
    }

    .grade-title.grade-11 {
        color: #28a745;
        border-bottom-color: #28a745;
    }

    .grade-title.grade-12 {
        color: #6f42c1;
        border-bottom-color: #6f42c1;
    }

    .class-card-header {
        height: 100px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        display: flex;
        align-items: flex-end;
        padding: 16px;
        color: white;
        position: relative;
        overflow: hidden;
        justify-content: space-between;
    }

    /* Color variations untuk header - warna yang lebih bagus dan modern */
    .class-card:nth-child(1) .class-card-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }

    .class-card:nth-child(2) .class-card-header {
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
    }

    .class-card:nth-child(3) .class-card-header {
        background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
    }

    .class-card:nth-child(4) .class-card-header {
        background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
    }

    .class-card:nth-child(5) .class-card-header {
        background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
    }

    .class-card:nth-child(6) .class-card-header {
        background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%);
    }

    .class-card:nth-child(7) .class-card-header {
        background: linear-gradient(135deg, #ff9a9e 0%, #fecfef 100%);
    }

    .class-card:nth-child(8) .class-card-header {
        background: linear-gradient(135deg, #ffecd2 0%, #fcb69f 100%);
    }

    .class-card:nth-child(9) .class-card-header {
        background: linear-gradient(135deg, #a8c0ff 0%, #3f2b96 100%);
    }

    .class-card:nth-child(10) .class-card-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }

    .class-card:nth-child(11) .class-card-header {
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
    }

    .class-card:nth-child(12) .class-card-header {
        background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
    }

    .class-card:nth-child(13) .class-card-header {
        background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
    }

    .class-card:nth-child(14) .class-card-header {
        background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
    }

    .class-card:nth-child(15) .class-card-header {
        background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%);
    }

    .class-card:nth-child(16) .class-card-header {
        background: linear-gradient(135deg, #ff9a9e 0%, #fecfef 100%);
    }

    .class-card:nth-child(17) .class-card-header {
        background: linear-gradient(135deg, #ffecd2 0%, #fcb69f 100%);
    }

    .class-card:nth-child(18) .class-card-header {
        background: linear-gradient(135deg, #a8c0ff 0%, #3f2b96 100%);
    }

    .class-card-header-title {
        font-size: 16px;
        font-weight: 600;
        margin: 0;
        color: white;
        flex: 1;
    }

    .class-card-name {
        font-size: 22px;
        font-weight: 700;
        color: #222;
        margin: 0 0 8px 0;
    }

    .class-card-note {
        margin-top: 6px;
        color: #555;
        font-size: 14px;
        line-height: 1.5;
    }

    .class-card-body {
        padding: 16px;
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .class-subject {
        color: #666;
        font-size: 13px;
        margin: 4px 0 0 0;
        font-weight: 500;
    }

    .class-info {
        margin-top: 8px;
        font-size: 12px;
        color: #999;
    }

    .class-actions {
        display: flex;
        gap: 8px;
        margin-top: auto;
        padding-top: 12px;
    }

    .class-actions .btn-sm {
        flex: 1;
        font-size: 13px;
        padding: 10px 12px;
        text-decoration: none;
        text-align: center;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
    }

    .class-actions-top {
        position: absolute;
        top: 12px;
        right: 12px;
        display: flex;
        gap: 8px;
        z-index: 2;
    }

    .class-actions-top .btn-icon {
        width: 32px;
        height: 32px;
        padding: 0;
        border-radius: 6px;
        background: rgba(255, 255, 255, 0.2);
        color: white;
        border: none;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.2s;
    }

    .class-actions-top .btn-icon:hover {
        background: rgba(255, 255, 255, 0.4);
    }

    .class-actions-top .btn-icon.delete {
        background: rgba(255, 59, 48, 0.3);
    }

    .class-actions-top .btn-icon.delete:hover {
        background: rgba(255, 59, 48, 0.6);
    }

    .classes-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 20px;
        margin-top: 24px;
    }

    .empty-state {
        text-align: center;
        padding: 60px 20px;
    }

    .empty-state-icon {
        font-size: 64px;
        color: #ddd;
        margin-bottom: 16px;
    }

    .empty-state-title {
        font-size: 20px;
        font-weight: 600;
        color: #666;
        margin-bottom: 8px;
    }

    .empty-state-text {
        color: #999;
        margin-bottom: 24px;
    }

    @media (max-width: 768px) {
        .classes-grid {
            grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
            gap: 16px;
        }
    }

    @media (max-width: 576px) {
        .classes-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="mb-1">Kelas Saya</h4>
        <p class="text-muted mb-0">Pilih kelas yang sudah dibentuk admin. Tampilan guru hanya menampilkan nama kelas, tanpa mata pelajaran atau jadwal.</p>
    </div>
    <a href="{{ route('teacher.classes.create') }}" class="btn btn-primary d-flex align-items-center gap-2">
        <i class="feather-plus" style="font-size: 18px;"></i>
        Buat Kelas
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="feather-check-circle me-2"></i>
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

@if($classes->isEmpty())
    <div class="empty-state">
        <div class="empty-state-icon">
            <i class="feather-folder-plus"></i>
        </div>
        <h5 class="empty-state-title">Belum ada kelas</h5>
        <p class="empty-state-text">Mulai buat kelas baru untuk memulai mengelola pembelajaran Anda</p>
        <a href="{{ route('teacher.classes.create') }}" class="btn btn-primary">
            <i class="feather-plus me-2"></i>Buat Kelas Pertama
        </a>
    </div>
@else
    @php
        $classesByGrade = [
            'grade-12' => $classes->filter(function($class) {
                $className = strtoupper($class->name);
                return strpos($className, 'XII') !== false || strpos($className, '12') !== false;
            }),
            'grade-11' => $classes->filter(function($class) {
                $className = strtoupper($class->name);
                return strpos($className, 'XI') !== false || strpos($className, '11') !== false;
            }),
            'grade-10' => $classes->filter(function($class) {
                $className = strtoupper($class->name);
                return (strpos($className, 'X ') !== false || strpos($className, '10') !== false) &&
                       strpos($className, 'XI') === false && strpos($className, 'XII') === false;
            })
        ];
    @endphp

    @foreach(['grade-12' => 'Kelas XII', 'grade-11' => 'Kelas XI', 'grade-10' => 'Kelas X'] as $gradeKey => $gradeLabel)
        @if($classesByGrade[$gradeKey]->count() > 0)
            <div class="grade-section mb-5">
                <div class="grade-header mb-3">
                    <h5 class="grade-title {{ $gradeKey }}">
                        <i class="feather-folder me-2"></i>
                        {{ $gradeLabel }}
                        <span class="badge bg-secondary ms-2">{{ $classesByGrade[$gradeKey]->count() }} kelas</span>
                    </h5>
                </div>
                <div class="classes-grid">
                    @foreach($classesByGrade[$gradeKey] as $class)
                        @php
                            $currentGradeClass = $gradeKey;
                        @endphp

                        <div class="class-card {{ $currentGradeClass }}">
                            <div class="class-card-header">
                                <div class="grade-badge {{ $currentGradeClass }}">
                                    @if($currentGradeClass === 'grade-10') 10 @elseif($currentGradeClass === 'grade-11') 11 @else 12 @endif
                                </div>
                                <div>
                                    <h5 class="class-card-header-title">{{ $class->name }}</h5>
                                </div>
                                <div class="class-actions-top">
                                    <a href="{{ route('teacher.classes.edit', $class) }}" class="btn-icon" title="Edit">
                                        <i class="feather-edit-2" style="font-size: 16px;"></i>
                                    </a>
                                    <form action="{{ route('teacher.classes.destroy', $class) }}" method="POST" class="d-inline" style="margin: 0;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-icon delete" title="Hapus" onclick="return confirm('Hapus kelas ini?')">
                                            <i class="feather-trash-2" style="font-size: 16px;"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                            <div class="class-card-body">
                                <div class="class-card-name">Kelas {{ $class->name }}</div>
                                <div class="class-card-note">Data kelas ini berasal dari proses admin. Guru melihat kelas jadi langsung dan simpel.</div>

                                <div class="class-actions">
                                    <a href="{{ route('teacher.students.class', $class) }}" class="btn btn-primary btn-sm">
                                        <i class="feather-arrow-right" style="font-size: 13px;"></i>
                                        Lihat Kelas
                                    </a>
                                    <a href="{{ route('teacher.attendance.by-class', $class) }}" class="btn btn-info btn-sm">
                                        <i class="feather-check-square" style="font-size: 13px;"></i>
                                        Absensi
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    @endforeach
@endif
@endsection
