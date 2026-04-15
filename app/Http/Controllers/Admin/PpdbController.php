<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PpdbApplication;
use App\Models\TeacherClass;
use App\Models\TeacherStudent;
use Illuminate\Http\Request;

class PpdbController extends Controller
{
    public function index()
    {
        $applications = PpdbApplication::latest()->paginate(10);

        return view('admin.ppdb.index', compact('applications'));
    }

    public function show(PpdbApplication $ppdb)
    {
        $classes = TeacherClass::with('teacher')->orderBy('name')->get();

        return view('admin.ppdb.show', [
            'application' => $ppdb,
            'classes' => $classes,
        ]);
    }

    public function updateStatus(Request $request, PpdbApplication $ppdb)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,approved,rejected',
        ]);

        $ppdb->update([
            'status' => $validated['status'],
        ]);

        return redirect()
            ->route('admin.ppdb.show', $ppdb)
            ->with('success', 'Status pendaftaran berhasil diperbarui.');
    }

    public function assign(Request $request, PpdbApplication $ppdb)
    {
        $validated = $request->validate([
            'teacher_class_id' => 'required|exists:teacher_classes,id',
        ]);

        $teacherClass = TeacherClass::with('teacher')->findOrFail($validated['teacher_class_id']);

        $ppdb->update([
            'status' => 'approved',
            'teacher_class_id' => $teacherClass->id,
        ]);

        TeacherStudent::updateOrCreate(
            [
                'email' => $ppdb->email,
                'teacher_class_id' => $teacherClass->id,
            ],
            [
                'name' => $ppdb->student_name,
                'phone' => $ppdb->phone,
                'notes' => 'Siswa hasil assign dari PPDB',
            ]
        );

        return redirect()
            ->route('admin.ppdb.show', $ppdb)
            ->with('success', 'Siswa berhasil dimasukkan ke kelas dan terhubung ke guru pengampu.');
    }

    public function destroy(PpdbApplication $ppdb)
    {
        $ppdb->delete();

        return redirect()
            ->route('admin.ppdb.index')
            ->with('success', 'Data PPDB berhasil dihapus.');
    }
}