<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\TeacherClass;
use App\Models\TeacherSchedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index()
    {
        $schedules = TeacherSchedule::with('class')->orderBy('day')->orderBy('start_time')->get();

        return view('teacher.schedule.index', compact('schedules'));
    }

    public function create()
    {
        $classes = TeacherClass::orderBy('name')->get();

        return view('teacher.schedule.form', compact('classes'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'teacher_class_id' => 'nullable|exists:teacher_classes,id',
            'day' => 'required|string|max:50',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i',
            'room' => 'nullable|string|max:100',
        ]);

        TeacherSchedule::create($data);

        return redirect()->route('teacher.schedule.index')->with('success', 'Jadwal berhasil disimpan.');
    }

    public function edit(TeacherSchedule $teacher_schedule)
    {
        $classes = TeacherClass::orderBy('name')->get();

        return view('teacher.schedule.form', ['schedule' => $teacher_schedule, 'classes' => $classes]);
    }

    public function update(Request $request, TeacherSchedule $teacher_schedule)
    {
        $data = $request->validate([
            'teacher_class_id' => 'nullable|exists:teacher_classes,id',
            'day' => 'required|string|max:50',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i',
            'room' => 'nullable|string|max:100',
        ]);

        $teacher_schedule->update($data);

        return redirect()->route('teacher.schedule.index')->with('success', 'Jadwal berhasil diperbarui.');
    }

    public function destroy(TeacherSchedule $teacher_schedule)
    {
        $teacher_schedule->delete();

        return redirect()->route('teacher.schedule.index')->with('success', 'Jadwal berhasil dihapus.');
    }
}