<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureStudentIsApproved
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        $role = strtolower((string) $user->role);

        if (!in_array($role, ['student', 'siswa'])) {
            return $next($request);
        }

        $status = strtolower((string) $user->status);

        if ($status === 'approved') {
            return $next($request);
        }

        return redirect()->route('student.pending');
    }
}