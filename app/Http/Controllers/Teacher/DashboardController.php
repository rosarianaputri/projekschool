<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\LoginActivity;
use App\Models\PpdbApplication;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
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
            ->with('documents')
            ->latest('updated_at')
            ->paginate(20)
            ->withQueryString();

        $documentCompletionStats = [
            'complete' => 0,
            'incomplete' => 0,
            'total' => $applications->count(),
        ];

        $applications->getCollection()->transform(function (PpdbApplication $application) use (&$documentCompletionStats) {
            $summary = $application->documentSummary();
            $application->setAttribute('document_summary', $summary);

            if ($summary['is_complete']) {
                $documentCompletionStats['complete']++;
            } else {
                $documentCompletionStats['incomplete']++;
            }

            return $application;
        });

        $studentLoginActivities = LoginActivity::query()
            ->whereIn('role', ['student', 'siswa'])
            ->latest('logged_in_at')
            ->limit(20)
            ->get();

        $studentStats = [
            'student_accounts' => User::query()->whereRaw('LOWER(role) IN (?, ?)', ['student', 'siswa'])->count(),
            'ppdb_total' => PpdbApplication::query()->count(),
            'ppdb_pending' => PpdbApplication::query()->where('status', 'pending')->count(),
            'ppdb_approved' => PpdbApplication::query()->where('status', 'approved')->count(),
            'ppdb_rejected' => PpdbApplication::query()->where('status', 'rejected')->count(),
        ];

        return view('teacher.dashboard', [
            'applications' => $applications,
            'search' => $search,
            'status' => $status,
            'documentCompletionStats' => $documentCompletionStats,
            'studentLoginActivities' => $studentLoginActivities,
            'studentStats' => $studentStats,
        ]);
    }
}
