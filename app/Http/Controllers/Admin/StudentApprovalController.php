<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class StudentApprovalController extends Controller
{
    public function index()
    {
        $students = User::query()
            ->whereIn('role', ['student', 'siswa'])
            ->latest()
            ->paginate(10);

        return view('admin.student-approvals.index', compact('students'));
    }

    public function updateStatus(Request $request, User $user)
    {
        $request->validate([
            'status' => 'required|in:pending,approved,rejected',
        ]);

        if (!in_array(strtolower((string) $user->role), ['student', 'siswa'])) {
            return redirect()
                ->route('admin.student-approvals.index')
                ->with('error', 'User ini bukan akun siswa.');
        }

        $user->update([
            'status' => $request->status,
        ]);

        return redirect()
            ->route('admin.student-approvals.index')
            ->with('success', 'Status akun siswa berhasil diperbarui.');
    }
}