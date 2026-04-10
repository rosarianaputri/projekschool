<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\TeacherClass;
use App\Models\TeacherStudent;
use Illuminate\Http\Request;

class StudentController extends TeacherBaseController
{
    public function index(Request $request)
    {
        $teacherId = $this->currentTeacherId();
        $classes = TeacherClass::withCount('students')
            ->where('teacher_id', $teacherId)
            ->orderBy('name')
            ->get();

        $selectedClass = null;
        $students = null;

        if ($request->filled('class_id')) {
            $selectedClass = TeacherClass::where('teacher_id', $teacherId)
                ->findOrFail($request->query('class_id'));

            $students = TeacherStudent::where('teacher_id', $teacherId)
                ->where('teacher_class_id', $selectedClass->id)
                ->orderBy('name')
                ->paginate(12);
        }

        return view('teacher.students.index', compact('classes', 'selectedClass', 'students'));
    }

    public function create()
    {
        $teacherId = $this->currentTeacherId();
        $classes = TeacherClass::where('teacher_id', $teacherId)->orderBy('name')->get();

        return view('teacher.students.form', compact('classes'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'nis' => 'nullable|string|max:50',
            'phone' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:255',
            'teacher_class_id' => 'nullable|exists:teacher_classes,id',
            'notes' => 'nullable|string',
        ]);

        $data['teacher_id'] = $this->currentTeacherId();
        TeacherStudent::create($data);

        return redirect()->route('teacher.students.index')->with('success', 'Data siswa berhasil disimpan.');
    }

    public function edit(TeacherStudent $student)
    {
        abort_unless($student->teacher_id === $this->currentTeacherId(), 403);

        $teacherId = $this->currentTeacherId();
        $classes = TeacherClass::where('teacher_id', $teacherId)->orderBy('name')->get();

        return view('teacher.students.form', compact('student', 'classes'));
    }

    public function update(Request $request, TeacherStudent $student)
    {
        abort_unless($student->teacher_id === $this->currentTeacherId(), 403);

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'nis' => 'nullable|string|max:50',
            'phone' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:255',
            'teacher_class_id' => 'nullable|exists:teacher_classes,id',
            'notes' => 'nullable|string',
        ]);

        $student->update($data);

        return redirect()->route('teacher.students.index')->with('success', 'Data siswa berhasil diperbarui.');
    }

    public function destroy(TeacherStudent $student)
    {
        abort_unless($student->teacher_id === $this->currentTeacherId(), 403);

        $student->delete();

        return redirect()->route('teacher.students.index')->with('success', 'Data siswa berhasil dihapus.');
    }

    public function showClass(TeacherClass $teacher_class)
    {
        $teacherId = $this->currentTeacherId();
        abort_unless($teacher_class->teacher_id === $teacherId, 403);

        $students = TeacherStudent::where('teacher_class_id', $teacher_class->id)
            ->orderBy('name')
            ->paginate(12);

        return view('teacher.students.class-list', compact('teacher_class', 'students'));
    }
}
