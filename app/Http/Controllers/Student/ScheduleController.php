<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\TeacherSchedule;
use App\Models\TeacherStudent;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index(Request $request)
    {
        $studentClass = TeacherStudent::with('class.teacher')
            ->where('email', $request->user()->email)
            ->latest()
            ->first();

        $schedules = TeacherSchedule::with('class.teacher')
            ->when($studentClass, function ($query) use ($studentClass) {
                $query->where('teacher_class_id', $studentClass->teacher_class_id);
            }, function ($query) {
                $query->whereRaw('1 = 0');
            })
            ->orderByRaw("FIELD(day, 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu')")
            ->orderBy('start_time')
            ->paginate(10);

        return view('student.schedule.index', compact('schedules', 'studentClass'));
    }
}