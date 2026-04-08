<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\TeacherClass;
use App\Models\TeacherStudent;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $teacherId = auth()->id();
        $students = TeacherStudent::with('class')
            ->where('teacher_id', $teacherId)
            ->orderBy('name')
            ->get();

        return view('teacher.students.index', compact('students'));
    }

    public function create()
    {
        $classes = TeacherClass::where('teacher_id', auth()->id())->orderBy('name')->get();

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

        $data['teacher_id'] = auth()->id();
        TeacherStudent::create($data);

        return redirect()->route('teacher.students.index')->with('success', 'Data siswa berhasil disimpan.');
    }

    public function edit(TeacherStudent $student)
    {
        abort_unless($student->teacher_id === auth()->id(), 403);

        $classes = TeacherClass::where('teacher_id', auth()->id())->orderBy('name')->get();

        return view('teacher.students.form', compact('student', 'classes'));
    }

    public function update(Request $request, TeacherStudent $student)
    {
        abort_unless($student->teacher_id === auth()->id(), 403);

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
        abort_unless($student->teacher_id === auth()->id(), 403);

        $student->delete();

        return redirect()->route('teacher.students.index')->with('success', 'Data siswa berhasil dihapus.');
    }
}
