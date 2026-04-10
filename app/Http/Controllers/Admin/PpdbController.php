<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PpdbApplication;
use App\Models\TeacherClass;
use App\Models\TeacherStudent;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class PpdbController extends Controller
{
    public function index(Request $request): View
    {
        $query = PpdbApplication::query();

        $search = trim((string) $request->query('search', ''));
        $status = (string) $request->query('status', '');

        if ($search !== '') {
            $query->where(function ($builder) use ($search) {
                $builder->where('registration_code', 'like', "%{$search}%")
                    ->orWhere('student_name', 'like', "%{$search}%")
                    ->orWhere('parent_name', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        if (in_array($status, ['pending', 'approved', 'rejected'], true)) {
            $query->where('status', $status);
        }

        $applications = $query
            ->latest()
            ->paginate(20)
            ->withQueryString();

        return view('admin.ppdb.index', [
            'applications' => $applications,
            'search' => $search,
            'status' => $status,
        ]);
    }

    public function create(): View
    {
        return view('admin.ppdb.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validatedData($request);

        PpdbApplication::create([
            ...$validated,
            'registration_code' => $this->generateRegistrationCode(),
            'status' => $validated['status'] ?? 'pending',
            'approved_at' => ($validated['status'] ?? 'pending') === 'approved' ? now() : null,
            'approved_by' => ($validated['status'] ?? 'pending') === 'approved' ? Auth::id() : null,
        ]);

        return redirect()->route('admin.ppdb.index')->with('status', 'ppdb_created');
    }

    public function show(PpdbApplication $ppdbApplication): View
    {
        $classes = TeacherClass::with('teacher')
            ->orderBy('name')
            ->get();

        return view('admin.ppdb.show', [
            'application' => $ppdbApplication,
            'classes' => $classes,
        ]);
    }

    public function assign(Request $request, PpdbApplication $ppdbApplication): RedirectResponse
    {
        $data = $request->validate([
            'teacher_class_id' => ['required', 'exists:teacher_classes,id'],
        ]);

        $teacherClass = TeacherClass::findOrFail($data['teacher_class_id']);

        TeacherStudent::firstOrCreate(
            [
                'teacher_class_id' => $teacherClass->id,
                'name' => $ppdbApplication->student_name,
                'phone' => $ppdbApplication->phone,
                'email' => $ppdbApplication->email,
            ],
            [
                'teacher_id' => $teacherClass->teacher_id,
                'nis' => null,
                'notes' => "Dari PPDB: {$ppdbApplication->registration_code}",
            ]
        );

        if ($ppdbApplication->status !== 'approved') {
            $ppdbApplication->update([
                'status' => 'approved',
                'approved_at' => now(),
                'approved_by' => Auth::id(),
            ]);
        }

        return back()->with('status', 'ppdb_assigned');
    }

    public function edit(PpdbApplication $ppdbApplication): View
    {
        return view('admin.ppdb.edit', [
            'application' => $ppdbApplication,
        ]);
    }

    public function update(Request $request, PpdbApplication $ppdbApplication): RedirectResponse
    {
        $validated = $this->validatedData($request);
        $nextStatus = $validated['status'] ?? $ppdbApplication->status;

        $ppdbApplication->update([
            ...$validated,
            'approved_at' => $nextStatus === 'approved' ? ($ppdbApplication->approved_at ?? now()) : null,
            'approved_by' => $nextStatus === 'approved' ? ($ppdbApplication->approved_by ?? Auth::id()) : null,
        ]);

        return redirect()->route('admin.ppdb.show', $ppdbApplication)->with('status', 'ppdb_updated');
    }

    public function approve(PpdbApplication $ppdbApplication): RedirectResponse
    {
        $ppdbApplication->update([
            'status' => 'approved',
            'approved_at' => now(),
            'approved_by' => Auth::id(),
        ]);

        return back()->with('status', 'ppdb_approved');
    }

    public function reject(PpdbApplication $ppdbApplication): RedirectResponse
    {
        $ppdbApplication->update([
            'status' => 'rejected',
            'approved_at' => null,
            'approved_by' => null,
        ]);

        return back()->with('status', 'ppdb_rejected');
    }

    public function destroy(PpdbApplication $ppdbApplication): RedirectResponse
    {
        $ppdbApplication->delete();

        return redirect()->route('admin.ppdb.index')->with('status', 'ppdb_deleted');
    }

    private function validatedData(Request $request): array
    {
        return $request->validate([
            'student_name' => ['required', 'string', 'max:150'],
            'gender' => ['required', 'in:L,P'],
            'birth_place' => ['required', 'string', 'max:100'],
            'birth_date' => ['required', 'date'],
            'previous_school' => ['nullable', 'string', 'max:150'],
            'parent_name' => ['required', 'string', 'max:150'],
            'phone' => ['required', 'string', 'max:30'],
            'email' => ['required', 'email', 'max:150'],
            'address' => ['required', 'string', 'max:1000'],
            'notes' => ['nullable', 'string', 'max:1000'],
            'status' => ['nullable', 'in:pending,approved,rejected'],
        ]);
    }

    private function generateRegistrationCode(): string
    {
        do {
            $code = 'PPDB-' . now()->format('Ymd') . '-' . str_pad((string) random_int(1, 9999), 4, '0', STR_PAD_LEFT);
        } while (PpdbApplication::where('registration_code', $code)->exists());

        return $code;
    }
}
