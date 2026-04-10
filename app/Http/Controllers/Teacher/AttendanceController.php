<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\TeacherAttendance;
use App\Models\TeacherClass;
use App\Models\TeacherStudent;
use Illuminate\Http\Request;

class AttendanceController extends TeacherBaseController
{
    public function index()
    {
        $teacherId = $this->currentTeacherId();
        $attendances = TeacherAttendance::with('class')
            ->whereHas('class', function ($query) use ($teacherId) {
                $query->where('teacher_id', $teacherId);
            })
            ->orderByDesc('date')
            ->paginate(10);

        return view('teacher.attendance.index', compact('attendances'));
    }

    public function create()
    {
        $teacherId = $this->currentTeacherId();
        $classes = TeacherClass::where('teacher_id', $teacherId)->orderBy('name')->get();

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
                ->where('teacher_id', $this->currentTeacherId())
                ->firstOrFail();
        }

        TeacherAttendance::create($data);

        return redirect()->route('teacher.attendance.index')->with('success', 'Data absensi berhasil disimpan.');
    }

    public function edit(TeacherAttendance $teacher_attendance)
    {
        abort_unless($teacher_attendance->class && $teacher_attendance->class->teacher_id === $this->currentTeacherId(), 403);

        $teacherId = $this->currentTeacherId();
        $classes = TeacherClass::where('teacher_id', $teacherId)->orderBy('name')->get();

        return view('teacher.attendance.form', ['attendance' => $teacher_attendance, 'classes' => $classes]);
    }

    public function update(Request $request, TeacherAttendance $teacher_attendance)
    {
        abort_unless($teacher_attendance->class && $teacher_attendance->class->teacher_id === $this->currentTeacherId(), 403);

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
                ->where('teacher_id', $this->currentTeacherId())
                ->firstOrFail();
        }

        $teacher_attendance->update($data);

        return redirect()->route('teacher.attendance.index')->with('success', 'Data absensi berhasil diperbarui.');
    }

    public function destroy(TeacherAttendance $teacher_attendance)
    {
        abort_unless($teacher_attendance->class && $teacher_attendance->class->teacher_id === $this->currentTeacherId(), 403);

        $teacher_attendance->delete();

        return redirect()->route('teacher.attendance.index')->with('success', 'Data absensi berhasil dihapus.');
    }

    public function byClass(TeacherClass $teacher_class)
    {
        $teacherId = $this->currentTeacherId();
        abort_unless($teacher_class->teacher_id === $teacherId, 403);

        $students = TeacherStudent::where('teacher_class_id', $teacher_class->id)
            ->orderBy('name')
            ->paginate(36);

        $today = now()->toDateString();
        $todayAttendance = TeacherAttendance::where('teacher_class_id', $teacher_class->id)
            ->where('date', $today)
            ->first();

        return view('teacher.attendance.by-class', compact('teacher_class', 'students', 'todayAttendance'));
    }

    public function storeByClass(Request $request, TeacherClass $teacher_class)
    {
        $teacherId = $this->currentTeacherId();
        abort_unless($teacher_class->teacher_id === $teacherId, 403);

        $data = $request->validate([
            'date' => 'required|date',
            'students' => 'required|array',
            'students.*.id' => 'required|exists:teacher_students,id',
            'students.*.status' => 'required|in:present,permission,sick,absent',
        ]);

        $attendance = [
            'present' => 0,
            'permission' => 0,
            'sick' => 0,
            'absent' => 0,
        ];

        foreach ($data['students'] as $student) {
            $status = $student['status'];
            if (in_array($status, ['present', 'permission', 'sick', 'absent'])) {
                $attendance[$status]++;
            }
        }

        TeacherAttendance::updateOrCreate(
            [
                'teacher_class_id' => $teacher_class->id,
                'date' => $data['date'],
            ],
            $attendance
        );

        return back()->with('success', 'Absensi kelas berhasil dicatat.');
    }
}
