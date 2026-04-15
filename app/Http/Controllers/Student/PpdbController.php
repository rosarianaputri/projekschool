<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\PpdbApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PpdbController extends Controller
{
    public function index(Request $request)
    {
        $application = PpdbApplication::where('email', $request->user()->email)->first();

        return view('student.ppdb.index', compact('application'));
    }

    public function create(Request $request)
    {
        $application = PpdbApplication::where('email', $request->user()->email)->first();

        return view('student.ppdb.formulir', compact('application'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_name' => 'required|string|max:255',
            'gender' => 'required|string|max:10',
            'birth_place' => 'required|string|max:100',
            'birth_date' => 'required|date',
            'previous_school' => 'required|string|max:255',
            'parent_name' => 'required|string|max:255',
            'phone' => 'required|string|max:30',
            'address' => 'required|string',
            'notes' => 'nullable|string',
        ]);

        $application = PpdbApplication::where('email', $request->user()->email)->first();

        $payload = [
            'student_name' => $validated['student_name'],
            'gender' => $validated['gender'],
            'birth_place' => $validated['birth_place'],
            'birth_date' => $validated['birth_date'],
            'previous_school' => $validated['previous_school'],
            'parent_name' => $validated['parent_name'],
            'phone' => $validated['phone'],
            'address' => $validated['address'],
            'email' => $request->user()->email,
            'notes' => $validated['notes'] ?? null,
            'status' => 'pending',
        ];

        if ($application) {
            $application->update($payload);
            $registrationCode = $application->registration_code;
        } else {
            $payload['registration_code'] = $this->generateRegistrationCode();

            $application = PpdbApplication::create($payload);
            $registrationCode = $application->registration_code;
        }

        return redirect()
            ->route('student.formulir')
            ->with('status', 'ppdb_submitted')
            ->with('registration_code', $registrationCode);
    }

    private function generateRegistrationCode(): string
    {
        do {
            $code = 'PPDB-' . strtoupper(Str::random(6));
        } while (PpdbApplication::where('registration_code', $code)->exists());

        return $code;
    }
}