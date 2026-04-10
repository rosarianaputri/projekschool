<?php

namespace App\Http\Controllers\Teacher;

use App\Models\TeacherClass;
use App\Models\TeacherSchedule;
use Illuminate\Http\Request;

class ScheduleController extends TeacherBaseController
{
    public function index()
    {
        $teacherId = $this->currentTeacherId();
        $schedules = TeacherSchedule::with('class')
            ->whereHas('class', function ($query) use ($teacherId) {
                $query->where('teacher_id', $teacherId);
            })
            ->orderBy('day')
            ->orderBy('start_time')
            ->paginate(10);

        return view('teacher.schedule.index', compact('schedules'));
    }

    public function create()
    {
        $teacherId = $this->currentTeacherId();
        $classes = TeacherClass::where('teacher_id', $teacherId)->orderBy('name')->get();

        return view('teacher.schedule.form', compact('classes'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'teacher_class_id' => 'required|exists:teacher_classes,id',
            'day' => 'required|string|max:50',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i',
            'room' => 'nullable|string|max:100',
        ]);

        TeacherClass::where('id', $data['teacher_class_id'])
            ->where('teacher_id', $this->currentTeacherId())
            ->firstOrFail();

        TeacherSchedule::create($data);

        return redirect()->route('teacher.schedule.index')->with('success', 'Jadwal berhasil disimpan.');
    }

    public function edit(TeacherSchedule $teacher_schedule)
    {
        abort_unless($teacher_schedule->class && $teacher_schedule->class->teacher_id === $this->currentTeacherId(), 403);

        $teacherId = $this->currentTeacherId();
        $classes = TeacherClass::where('teacher_id', $teacherId)->orderBy('name')->get();

        return view('teacher.schedule.form', ['schedule' => $teacher_schedule, 'classes' => $classes]);
    }

    public function update(Request $request, TeacherSchedule $teacher_schedule)
    {
        abort_unless($teacher_schedule->class && $teacher_schedule->class->teacher_id === $this->currentTeacherId(), 403);

        $data = $request->validate([
            'teacher_class_id' => 'required|exists:teacher_classes,id',
            'day' => 'required|string|max:50',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i',
            'room' => 'nullable|string|max:100',
        ]);

        TeacherClass::where('id', $data['teacher_class_id'])
            ->where('teacher_id', $this->currentTeacherId())
            ->firstOrFail();

        $teacher_schedule->update($data);

        return redirect()->route('teacher.schedule.index')->with('success', 'Jadwal berhasil diperbarui.');
    }

    public function destroy(TeacherSchedule $teacher_schedule)
    {
        abort_unless($teacher_schedule->class && $teacher_schedule->class->teacher_id === $this->currentTeacherId(), 403);

        return redirect()->route('teacher.schedule.index')->with('success', 'Jadwal berhasil dihapus.');
    }
}