<?php

namespace App\Http\Controllers\Teacher;

use App\Models\TeacherClass;
use Illuminate\Http\Request;

class ClassController extends TeacherBaseController
{
    public function index()
    {
        $teacherId = $this->currentTeacherId();
        $classes = TeacherClass::where('teacher_id', $teacherId)->orderBy('name')->paginate(10);

        return view('teacher.classes.index', compact('classes'));
    }

    public function create()
    {
        return view('teacher.classes.form');
    }

    public function store(Request $request)
    {
        $teacherId = $this->currentTeacherId();

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
            'semester' => 'nullable|string|max:100',
            'schedule' => 'nullable|string|max:255',
            'room' => 'nullable|string|max:100',
        ]);

        $data['teacher_id'] = $teacherId;
        TeacherClass::create($data);

        return redirect()->route('teacher.classes.index')->with('success', 'Kelas berhasil ditambahkan.');
    }

    public function edit(TeacherClass $teacher_class)
    {
        abort_unless($teacher_class->teacher_id === $this->currentTeacherId(), 403);

        return view('teacher.classes.form', ['teacher_class' => $teacher_class]);
    }

    public function update(Request $request, TeacherClass $teacher_class)
    {
        abort_unless($teacher_class->teacher_id === $this->currentTeacherId(), 403);

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
            'semester' => 'nullable|string|max:100',
            'schedule' => 'nullable|string|max:255',
            'room' => 'nullable|string|max:100',
        ]);

        $teacher_class->update($data);

        return redirect()->route('teacher.classes.index')->with('success', 'Kelas berhasil diperbarui.');
    }

    public function destroy(TeacherClass $teacher_class)
    {
        abort_unless($teacher_class->teacher_id === $this->currentTeacherId(), 403);

        $teacher_class->delete();

        return redirect()->route('teacher.classes.index')->with('success', 'Kelas berhasil dihapus.');
    }
}
