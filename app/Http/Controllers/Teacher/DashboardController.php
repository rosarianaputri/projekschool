<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\TeacherAssignment;
use App\Models\TeacherAttendance;
use App\Models\TeacherClass;
use App\Models\TeacherGrade;
use App\Models\TeacherMaterial;
use App\Models\TeacherSchedule;
use App\Models\TeacherStudent;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $teacherId = auth()->user()->teacher?->id;
        abort_unless($teacherId, 403);

        $stats = [
            'classes' => TeacherClass::where('teacher_id', $teacherId)->count(),
            'students' => TeacherStudent::where('teacher_id', $teacherId)->count(),
            'subjects' => TeacherClass::where('teacher_id', $teacherId)->distinct('subject')->count('subject'),
            'pending_tasks' => TeacherAssignment::whereHas('class', function ($query) use ($teacherId) {
                $query->where('teacher_id', $teacherId);
            })->where('status', 'draft')->count(),
            'attendance_alerts' => TeacherAttendance::whereHas('class', function ($query) use ($teacherId) {
                $query->where('teacher_id', $teacherId);
            })->whereDate('date', now())->count(),
        ];

        $classes = TeacherClass::where('teacher_id', $teacherId)
            ->withCount('students')
            ->orderBy('name')
            ->limit(4)
            ->get();
        $todaySchedule = TeacherSchedule::whereHas('class', function ($query) use ($teacherId) {
                $query->where('teacher_id', $teacherId);
            })
            ->orderBy('day')
            ->orderBy('start_time')
            ->limit(3)
            ->get()
            ->map(function ($schedule) {
                return [
                    'time' => $schedule->start_time,
                    'title' => ($schedule->class->name ?? '-') . ' - ' . ($schedule->class->subject ?? '-'),
                    'location' => $schedule->room ?: 'Ruang belum diisi',
                ];
            });

        $alerts = [
            sprintf('%s tugas belum dinilai', TeacherAssignment::whereHas('class', function ($query) use ($teacherId) {
                $query->where('teacher_id', $teacherId);
            })->where('status', 'draft')->count()),
            sprintf('%s catatan absensi untuk hari ini', TeacherAttendance::whereHas('class', function ($query) use ($teacherId) {
                $query->where('teacher_id', $teacherId);
            })->whereDate('date', now())->count()),
            sprintf('%s siswa memiliki catatan khusus', TeacherStudent::where('teacher_id', $teacherId)->whereNotNull('notes')->count()),
        ];

        return view('teacher.dashboard', compact('stats', 'classes', 'todaySchedule', 'alerts'));
    }
}