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

class ReportController extends Controller
{
    public function index()
    {
        $summary = [
            'classes' => TeacherClass::count(),
            'students' => TeacherStudent::count(),
            'assignments' => TeacherAssignment::count(),
            'materials' => TeacherMaterial::count(),
            'grades' => TeacherGrade::count(),
            'attendance_records' => TeacherAttendance::count(),
        ];

        $topClasses = TeacherClass::limit(4)->get();

        return view('teacher.reports.index', compact('summary', 'topClasses'));
    }
}