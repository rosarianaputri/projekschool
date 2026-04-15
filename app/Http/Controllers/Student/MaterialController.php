<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\TeacherMaterial;
use App\Models\TeacherStudent;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    public function index(Request $request)
    {
        $studentClass = TeacherStudent::where('email', $request->user()->email)->latest()->first();

        $materials = TeacherMaterial::with('class.teacher')
            ->when($studentClass, function ($query) use ($studentClass) {
                $query->where('teacher_class_id', $studentClass->teacher_class_id);
            }, function ($query) {
                $query->whereRaw('1 = 0');
            })
            ->latest()
            ->paginate(9);

        return view('student.materials.index', compact('materials', 'studentClass'));
    }
}