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
        $stats = [
            'classes' => TeacherClass::count(),
            'students' => TeacherStudent::count(),
            'subjects' => TeacherClass::distinct('subject')->count('subject'),
            'pending_tasks' => TeacherAssignment::where('status', 'draft')->count(),
            'attendance_alerts' => TeacherAttendance::whereDate('date', now())->count(),
        ];

        $classes = TeacherClass::orderBy('name')->limit(4)->get();
        $todaySchedule = TeacherSchedule::orderBy('day')->orderBy('start_time')->limit(3)->get()->map(function ($schedule) {
            return [
                'time' => $schedule->start_time,
                'title' => ($schedule->class->name ?? '-') . ' - ' . ($schedule->class->subject ?? '-'),
                'location' => $schedule->room ?: 'Ruang belum diisi',
            ];
        });

        $alerts = [
            sprintf('%s tugas belum dinilai', TeacherAssignment::where('status', 'draft')->count()),
            sprintf('%s catatan absensi untuk hari ini', TeacherAttendance::whereDate('date', now())->count()),
            sprintf('%s siswa memiliki catatan khusus', TeacherStudent::whereNotNull('notes')->count()),
        ];

        return view('teacher.dashboard', compact('stats', 'classes', 'todaySchedule', 'alerts'));
    }
}