<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\TeacherAssignment;
use App\Models\TeacherClass;
use Illuminate\Http\Request;

class AssignmentController extends Controller
{
    public function index()
    {
        $assignments = TeacherAssignment::with('class')->orderBy('due_date')->get();

        return view('teacher.assignments.index', compact('assignments'));
    }

    public function create()
    {
        $classes = TeacherClass::orderBy('name')->get();

        return view('teacher.assignments.form', compact('classes'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'teacher_class_id' => 'nullable|exists:teacher_classes,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
            'status' => 'required|string|in:draft,published,completed',
        ]);

        TeacherAssignment::create($data);

        return redirect()->route('teacher.assignments.index')->with('success', 'Tugas berhasil disimpan.');
    }

    public function edit(TeacherAssignment $teacher_assignment)
    {
        $classes = TeacherClass::orderBy('name')->get();

        return view('teacher.assignments.form', ['assignment' => $teacher_assignment, 'classes' => $classes]);
    }

    public function update(Request $request, TeacherAssignment $teacher_assignment)
    {
        $data = $request->validate([
            'teacher_class_id' => 'nullable|exists:teacher_classes,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
            'status' => 'required|string|in:draft,published,completed',
        ]);

        $teacher_assignment->update($data);

        return redirect()->route('teacher.assignments.index')->with('success', 'Tugas berhasil diperbarui.');
    }

    public function destroy(TeacherAssignment $teacher_assignment)
    {
        $teacher_assignment->delete();

        return redirect()->route('teacher.assignments.index')->with('success', 'Tugas berhasil dihapus.');
    }
}