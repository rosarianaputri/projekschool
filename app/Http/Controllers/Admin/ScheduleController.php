<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TeacherClass;
use App\Models\TeacherSchedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index()
    {
        $schedules = TeacherSchedule::with(['class.teacher'])->latest()->paginate(10);

        return view('admin.schedules.index', compact('schedules'));
    }

    public function create()
    {
        $classes = TeacherClass::with('teacher')->orderBy('name')->get();

        return view('admin.schedules.create', compact('classes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'teacher_class_id' => 'required|exists:teacher_classes,id',
            'day' => 'required|string|max:50',
            'start_time' => 'required',
            'end_time' => 'required',
            'room' => 'nullable|string|max:100',
        ]);

        TeacherSchedule::create($validated);

        return redirect()
            ->route('admin.schedules.index')
            ->with('success', 'Jadwal berhasil ditambahkan.');
    }

    public function edit(TeacherSchedule $schedule)
    {
        $classes = TeacherClass::with('teacher')->orderBy('name')->get();

        return view('admin.schedules.edit', [
            'schedule' => $schedule,
            'classes' => $classes,
        ]);
    }

    public function update(Request $request, TeacherSchedule $schedule)
    {
        $validated = $request->validate([
            'teacher_class_id' => 'required|exists:teacher_classes,id',
            'day' => 'required|string|max:50',
            'start_time' => 'required',
            'end_time' => 'required',
            'room' => 'nullable|string|max:100',
        ]);

        $schedule->update($validated);

        return redirect()
            ->route('admin.schedules.index')
            ->with('success', 'Jadwal berhasil diperbarui.');
    }

    public function destroy(TeacherSchedule $schedule)
    {
        $schedule->delete();

        return redirect()
            ->route('admin.schedules.index')
            ->with('success', 'Jadwal berhasil dihapus.');
    }
}