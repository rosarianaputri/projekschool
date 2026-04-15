<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use App\Models\TeacherClass;
use Illuminate\Http\Request;

class ClassController extends Controller
{
    public function index()
    {
        $classes = TeacherClass::with('teacher')->latest()->paginate(10);

        return view('admin.classes.index', compact('classes'));
    }

    public function create()
    {
        $teachers = Teacher::orderBy('name')->get();

        return view('admin.classes.create', compact('teachers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'teacher_id' => 'required|exists:teachers,id',
            'name' => 'required|string|max:100',
            'subject' => 'required|string|max:100',
            'semester' => 'nullable|string|max:20',
            'schedule' => 'nullable|string|max:255',
            'room' => 'nullable|string|max:100',
        ]);

        TeacherClass::create($validated);

        return redirect()
            ->route('admin.classes.index')
            ->with('success', 'Kelas berhasil ditambahkan.');
    }

    public function edit(TeacherClass $class)
    {
        $teachers = Teacher::orderBy('name')->get();

        return view('admin.classes.edit', [
            'teacher_class' => $class,
            'teachers' => $teachers,
        ]);
    }

    public function update(Request $request, TeacherClass $class)
    {
        $validated = $request->validate([
            'teacher_id' => 'required|exists:teachers,id',
            'name' => 'required|string|max:100',
            'subject' => 'required|string|max:100',
            'semester' => 'nullable|string|max:20',
            'schedule' => 'nullable|string|max:255',
            'room' => 'nullable|string|max:100',
        ]);

        $class->update($validated);

        return redirect()
            ->route('admin.classes.index')
            ->with('success', 'Kelas berhasil diperbarui.');
    }

    public function destroy(TeacherClass $class)
    {
        $class->delete();

        return redirect()
            ->route('admin.classes.index')
            ->with('success', 'Kelas berhasil dihapus.');
    }
}