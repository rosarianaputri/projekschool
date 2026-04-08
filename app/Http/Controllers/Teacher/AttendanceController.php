<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\TeacherAttendance;
use App\Models\TeacherClass;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index()
    {
        $teacherId = auth()->id();
        $attendances = TeacherAttendance::with('class')
            ->whereHas('class', function ($query) use ($teacherId) {
                $query->where('teacher_id', $teacherId);
            })
            ->orderByDesc('date')
            ->get();

        return view('teacher.attendance.index', compact('attendances'));
    }

    public function create()
    {
        $classes = TeacherClass::where('teacher_id', auth()->id())->orderBy('name')->get();

        return view('teacher.attendance.form', compact('classes'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'teacher_class_id' => 'nullable|exists:teacher_classes,id',
            'date' => 'required|date',
            'present' => 'required|integer|min:0',
            'permission' => 'required|integer|min:0',
            'sick' => 'required|integer|min:0',
            'absent' => 'required|integer|min:0',
            'note' => 'nullable|string',
        ]);

        if ($data['teacher_class_id']) {
            TeacherClass::where('id', $data['teacher_class_id'])
                ->where('teacher_id', auth()->id())
                ->firstOrFail();
        }

        TeacherAttendance::create($data);

        return redirect()->route('teacher.attendance.index')->with('success', 'Data absensi berhasil disimpan.');
    }

    public function edit(TeacherAttendance $teacher_attendance)
    {
        abort_unless($teacher_attendance->class && $teacher_attendance->class->teacher_id === auth()->id(), 403);

        $classes = TeacherClass::where('teacher_id', auth()->id())->orderBy('name')->get();

        return view('teacher.attendance.form', ['attendance' => $teacher_attendance, 'classes' => $classes]);
    }

    public function update(Request $request, TeacherAttendance $teacher_attendance)
    {
        abort_unless($teacher_attendance->class && $teacher_attendance->class->teacher_id === auth()->id(), 403);

        $data = $request->validate([
            'teacher_class_id' => 'nullable|exists:teacher_classes,id',
            'date' => 'required|date',
            'present' => 'required|integer|min:0',
            'permission' => 'required|integer|min:0',
            'sick' => 'required|integer|min:0',
            'absent' => 'required|integer|min:0',
            'note' => 'nullable|string',
        ]);

        if ($data['teacher_class_id']) {
            TeacherClass::where('id', $data['teacher_class_id'])
                ->where('teacher_id', auth()->id())
                ->firstOrFail();
        }

        $teacher_attendance->update($data);

        return redirect()->route('teacher.attendance.index')->with('success', 'Data absensi berhasil diperbarui.');
    }

    public function destroy(TeacherAttendance $teacher_attendance)
    {
        abort_unless($teacher_attendance->class && $teacher_attendance->class->teacher_id === auth()->id(), 403);

        $teacher_attendance->delete();

        return redirect()->route('teacher.attendance.index')->with('success', 'Data absensi berhasil dihapus.');
    }
}
