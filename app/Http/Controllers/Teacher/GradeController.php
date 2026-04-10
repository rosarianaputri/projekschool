<?php

namespace App\Http\Controllers\Teacher;

use App\Models\TeacherClass;
use App\Models\TeacherGrade;
use Illuminate\Http\Request;

class GradeController extends TeacherBaseController
{
    public function index()
    {
        $teacherId = $this->currentTeacherId();
        $grades = TeacherGrade::with('class')
            ->whereHas('class', function ($query) use ($teacherId) {
                $query->where('teacher_id', $teacherId);
            })
            ->orderBy('student_name')
            ->paginate(10);

        return view('teacher.grades.index', compact('grades'));
    }

    public function create()
    {
        $teacherId = $this->currentTeacherId();
        $classes = TeacherClass::with('students')->where('teacher_id', $teacherId)->orderBy('name')->get();

        return view('teacher.grades.form', compact('classes'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'teacher_class_id' => 'required|exists:teacher_classes,id',
            'student_name' => 'required|string|max:255',
            'category' => 'nullable|string|max:100',
            'score' => 'required|integer|min:0|max:100',
            'note' => 'nullable|string',
        ]);

        TeacherClass::where('id', $data['teacher_class_id'])
            ->where('teacher_id', $this->currentTeacherId())
            ->firstOrFail();

        TeacherGrade::create($data);

        return redirect()->route('teacher.grades.index')->with('success', 'Nilai berhasil disimpan.');
    }

    public function edit(TeacherGrade $teacher_grade)
    {
        abort_unless($teacher_grade->class && $teacher_grade->class->teacher_id === $this->currentTeacherId(), 403);

        $teacherId = $this->currentTeacherId();
        $classes = TeacherClass::with('students')->where('teacher_id', $teacherId)->orderBy('name')->get();

        return view('teacher.grades.form', ['grade' => $teacher_grade, 'classes' => $classes]);
    }

    public function update(Request $request, TeacherGrade $teacher_grade)
    {
        abort_unless($teacher_grade->class && $teacher_grade->class->teacher_id === $this->currentTeacherId(), 403);

        $data = $request->validate([
            'teacher_class_id' => 'required|exists:teacher_classes,id',
            'student_name' => 'required|string|max:255',
            'category' => 'nullable|string|max:100',
            'score' => 'required|integer|min:0|max:100',
            'note' => 'nullable|string',
        ]);

        TeacherClass::where('id', $data['teacher_class_id'])
            ->where('teacher_id', $this->currentTeacherId())
            ->firstOrFail();

        $teacher_grade->update($data);

        return redirect()->route('teacher.grades.index')->with('success', 'Nilai berhasil diperbarui.');
    }

    public function destroy(TeacherGrade $teacher_grade)
    {
        abort_unless($teacher_grade->class && $teacher_grade->class->teacher_id === $this->currentTeacherId(), 403);

        $teacher_grade->delete();

        return redirect()->route('teacher.grades.index')->with('success', 'Nilai berhasil dihapus.');
    }
}