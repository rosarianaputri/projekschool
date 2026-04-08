<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\TeacherClass;
use App\Models\TeacherMaterial;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    public function index()
    {
        $materials = TeacherMaterial::with('class')->orderByDesc('created_at')->get();

        return view('teacher.materials.index', compact('materials'));
    }

    public function create()
    {
        $classes = TeacherClass::orderBy('name')->get();

        return view('teacher.materials.form', compact('classes'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'teacher_class_id' => 'nullable|exists:teacher_classes,id',
            'title' => 'required|string|max:255',
            'type' => 'nullable|string|max:100',
            'link' => 'nullable|url|max:255',
            'notes' => 'nullable|string',
        ]);

        TeacherMaterial::create($data);

        return redirect()->route('teacher.materials.index')->with('success', 'Materi berhasil disimpan.');
    }

    public function edit(TeacherMaterial $teacher_material)
    {
        $classes = TeacherClass::orderBy('name')->get();

        return view('teacher.materials.form', ['material' => $teacher_material, 'classes' => $classes]);
    }

    public function update(Request $request, TeacherMaterial $teacher_material)
    {
        $data = $request->validate([
            'teacher_class_id' => 'nullable|exists:teacher_classes,id',
            'title' => 'required|string|max:255',
            'type' => 'nullable|string|max:100',
            'link' => 'nullable|url|max:255',
            'notes' => 'nullable|string',
        ]);

        $teacher_material->update($data);

        return redirect()->route('teacher.materials.index')->with('success', 'Materi berhasil diperbarui.');
    }

    public function destroy(TeacherMaterial $teacher_material)
    {
        $teacher_material->delete();

        return redirect()->route('teacher.materials.index')->with('success', 'Materi berhasil dihapus.');
    }
}