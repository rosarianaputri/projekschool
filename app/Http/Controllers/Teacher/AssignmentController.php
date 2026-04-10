<?php

namespace App\Http\Controllers\Teacher;

use App\Models\TeacherAssignment;
use App\Models\TeacherClass;
use Illuminate\Http\Request;

class AssignmentController extends TeacherBaseController
{
    public function index()
    {
        $teacherId = $this->currentTeacherId();
        $assignments = TeacherAssignment::with('class')
            ->whereHas('class', function ($query) use ($teacherId) {
                $query->where('teacher_id', $teacherId);
            })
            ->orderBy('due_date')
            ->paginate(10);

        return view('teacher.assignments.index', compact('assignments'));
    }

    public function create()
    {
        $teacherId = $this->currentTeacherId();
        $classes = TeacherClass::where('teacher_id', $teacherId)->orderBy('name')->get();

        return view('teacher.assignments.form', compact('classes'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'teacher_class_id' => 'required|exists:teacher_classes,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
            'status' => 'required|string|in:draft,published,completed',
        ]);

        TeacherClass::where('id', $data['teacher_class_id'])
            ->where('teacher_id', $this->currentTeacherId())
            ->firstOrFail();

        TeacherAssignment::create($data);

        return redirect()->route('teacher.assignments.index')->with('success', 'Tugas berhasil disimpan.');
    }

    public function edit(TeacherAssignment $teacher_assignment)
    {
        abort_unless($teacher_assignment->class && $teacher_assignment->class->teacher_id === $this->currentTeacherId(), 403);

        $teacherId = $this->currentTeacherId();
        $classes = TeacherClass::where('teacher_id', $teacherId)->orderBy('name')->get();

        return view('teacher.assignments.form', ['assignment' => $teacher_assignment, 'classes' => $classes]);
    }

    public function update(Request $request, TeacherAssignment $teacher_assignment)
    {
        abort_unless($teacher_assignment->class && $teacher_assignment->class->teacher_id === $this->currentTeacherId(), 403);

        $data = $request->validate([
            'teacher_class_id' => 'required|exists:teacher_classes,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
            'status' => 'required|string|in:draft,published,completed',
        ]);

        TeacherClass::where('id', $data['teacher_class_id'])
            ->where('teacher_id', $this->currentTeacherId())
            ->firstOrFail();

        $teacher_assignment->update($data);

        return redirect()->route('teacher.assignments.index')->with('success', 'Tugas berhasil diperbarui.');
    }

    public function destroy(TeacherAssignment $teacher_assignment)
    {
        abort_unless($teacher_assignment->class && $teacher_assignment->class->teacher_id === $this->currentTeacherId(), 403);

        return redirect()->route('teacher.assignments.index')->with('success', 'Tugas berhasil dihapus.');
    }
}