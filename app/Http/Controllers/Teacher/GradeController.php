<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\TeacherClass;
use App\Models\TeacherGrade;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    public function index()
    {
        $grades = TeacherGrade::with('class')->orderBy('student_name')->get();

        return view('teacher.grades.index', compact('grades'));
    }

    public function create()
    {
        $classes = TeacherClass::orderBy('name')->get();

        return view('teacher.grades.form', compact('classes'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'teacher_class_id' => 'nullable|exists:teacher_classes,id',
            'student_name' => 'required|string|max:255',
            'category' => 'nullable|string|max:100',
            'score' => 'required|integer|min:0|max:100',
            'note' => 'nullable|string',
        ]);

        TeacherGrade::create($data);

        return redirect()->route('teacher.grades.index')->with('success', 'Nilai berhasil disimpan.');
    }

    public function edit(TeacherGrade $teacher_grade)
    {
        $classes = TeacherClass::orderBy('name')->get();

        return view('teacher.grades.form', ['grade' => $teacher_grade, 'classes' => $classes]);
    }

    public function update(Request $request, TeacherGrade $teacher_grade)
    {
        $data = $request->validate([
            'teacher_class_id' => 'nullable|exists:teacher_classes,id',
            'student_name' => 'required|string|max:255',
            'category' => 'nullable|string|max:100',
            'score' => 'required|integer|min:0|max:100',
            'note' => 'nullable|string',
        ]);

        $teacher_grade->update($data);

        return redirect()->route('teacher.grades.index')->with('success', 'Nilai berhasil diperbarui.');
    }

    public function destroy(TeacherGrade $teacher_grade)
    {
        $teacher_grade->delete();

        return redirect()->route('teacher.grades.index')->with('success', 'Nilai berhasil dihapus.');
    }
}