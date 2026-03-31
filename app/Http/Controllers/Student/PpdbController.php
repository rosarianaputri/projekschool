<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\PpdbApplication;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class PpdbController extends Controller
{
    public function index(): RedirectResponse
    {
        return redirect()->route('student.formulir');
    }

    public function create(Request $request): View
    {
        $user = $request->user();
        $application = PpdbApplication::where('email', $user->email)->first();

        return view('student.formulir', [
            'application' => $application,
            'user' => $user,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $user = $request->user();

        $validated = $request->validate([
            'student_name' => 'required|string|max:100',
            'gender' => 'required|in:L,P',
            'birth_place' => 'required|string|max:100',
            'birth_date' => 'required|date',
            'previous_school' => 'nullable|string|max:150',
            'parent_name' => 'required|string|max:100',
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
            'notes' => 'nullable|string',
        ]);

        $application = PpdbApplication::where('email', $user->email)->first();

        $payload = array_merge($validated, [
            'email' => $user->email,
            'status' => 'pending',
            'registration_code' => $application?->registration_code ?? $this->generateRegistrationCode(),
        ]);

        if ($application) {
            $application->update($payload);
        } else {
            PpdbApplication::create($payload);
        }

        return redirect()
            ->route('student.formulir')
            ->with('status', 'ppdb_submitted')
            ->with('registration_code', $payload['registration_code']);
    }

    private function generateRegistrationCode(): string
    {
        do {
            $code = 'PPDB-'.strtoupper(Str::random(6));
        } while (PpdbApplication::where('registration_code', $code)->exists());

        return $code;
    }
}
