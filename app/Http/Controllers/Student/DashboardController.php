<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\PpdbApplication;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $step = $request->get('step', 0);

        $application = PpdbApplication::query()
            ->where('email', $request->user()->email)
            ->with('documents')
            ->first();

        return view('student.dashboard', [
            'step' => $step,
            'application' => $application,
            'documentSummary' => $application?->documentSummary(),
        ]);
    }
}