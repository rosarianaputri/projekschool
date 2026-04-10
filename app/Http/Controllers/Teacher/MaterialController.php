<?php

namespace App\Http\Controllers\Teacher;

use App\Models\TeacherClass;
use App\Models\TeacherMaterial;
use Illuminate\Http\Request;

class MaterialController extends TeacherBaseController
{
    public function index()
    {
        $teacherId = $this->currentTeacherId();
        $materials = TeacherMaterial::with('class')
            ->whereHas('class', function ($query) use ($teacherId) {
                $query->where('teacher_id', $teacherId);
            })
            ->orderByDesc('created_at')
            ->paginate(10);

        return view('teacher.materials.index', compact('materials'));
    }

    public function create()
    {
        $teacherId = $this->currentTeacherId();
        $classes = TeacherClass::where('teacher_id', $teacherId)->orderBy('name')->get();

        return view('teacher.materials.form', compact('classes'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'teacher_class_id' => 'required|exists:teacher_classes,id',
            'title' => 'required|string|max:255',
            'type' => 'nullable|string|max:100',
            'link' => 'nullable|url|max:255',
            'notes' => 'nullable|string',
        ]);

        TeacherClass::where('id', $data['teacher_class_id'])
            ->where('teacher_id', $this->currentTeacherId())
            ->firstOrFail();

        TeacherMaterial::create($data);

        return redirect()->route('teacher.materials.index')->with('success', 'Materi berhasil disimpan.');
    }

    public function edit(TeacherMaterial $teacher_material)
    {
        abort_unless($teacher_material->class && $teacher_material->class->teacher_id === $this->currentTeacherId(), 403);

        $teacherId = $this->currentTeacherId();
        $classes = TeacherClass::where('teacher_id', $teacherId)->orderBy('name')->get();

        return view('teacher.materials.form', ['material' => $teacher_material, 'classes' => $classes]);
    }

    public function update(Request $request, TeacherMaterial $teacher_material)
    {
        abort_unless($teacher_material->class && $teacher_material->class->teacher_id === $this->currentTeacherId(), 403);

        $data = $request->validate([
            'teacher_class_id' => 'required|exists:teacher_classes,id',
            'title' => 'required|string|max:255',
            'type' => 'nullable|string|max:100',
            'link' => 'nullable|url|max:255',
            'notes' => 'nullable|string',
        ]);

        TeacherClass::where('id', $data['teacher_class_id'])
            ->where('teacher_id', $this->currentTeacherId())
            ->firstOrFail();

        $teacher_material->update($data);

        return redirect()->route('teacher.materials.index')->with('success', 'Materi berhasil diperbarui.');
    }

    public function destroy(TeacherMaterial $teacher_material)
    {
        abort_unless($teacher_material->class && $teacher_material->class->teacher_id === $this->currentTeacherId(), 403);

        return redirect()->route('teacher.materials.index')->with('success', 'Materi berhasil dihapus.');
    }
}