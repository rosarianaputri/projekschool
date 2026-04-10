<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\TeacherAssignment;
use App\Models\TeacherAttendance;
use App\Models\TeacherClass;
use App\Models\TeacherGrade;
use App\Models\TeacherMaterial;
use App\Models\TeacherStudent;
use Illuminate\Http\Request;

class ReportController extends TeacherBaseController
{
    public function index()
    {
        $teacherId = $this->currentTeacherId();

        $summary = [
            'classes' => TeacherClass::where('teacher_id', $teacherId)->count(),
            'students' => TeacherStudent::where('teacher_id', $teacherId)->count(),
            'assignments' => TeacherAssignment::whereHas('class', function ($query) use ($teacherId) {
                $query->where('teacher_id', $teacherId);
            })->count(),
            'materials' => TeacherMaterial::whereHas('class', function ($query) use ($teacherId) {
                $query->where('teacher_id', $teacherId);
            })->count(),
            'grades' => TeacherGrade::whereHas('class', function ($query) use ($teacherId) {
                $query->where('teacher_id', $teacherId);
            })->count(),
            'attendance_records' => TeacherAttendance::whereHas('class', function ($query) use ($teacherId) {
                $query->where('teacher_id', $teacherId);
            })->count(),
        ];

        $topClasses = TeacherClass::where('teacher_id', $teacherId)->limit(4)->get();

        return view('teacher.reports.index', compact('summary', 'topClasses'));
    }
}