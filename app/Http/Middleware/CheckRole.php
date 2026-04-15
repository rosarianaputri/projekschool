<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle(Request $request, Closure $next, $role)
    {
        if (! Auth::check()) {
            return redirect()->route('login');
        }

        $expectedRole = $this->normalizeRole((string) $role);
        $actualRole = $this->normalizeRole((string) Auth::user()->role);

        if ($expectedRole === $actualRole) {
            return $next($request);
        }

        /** @var User $user */
        $user = Auth::user();

        return redirect()
            ->to($user->dashboardPath())
            ->with('error', 'Anda tidak punya akses ke halaman tersebut. Silakan gunakan area sesuai role akun Anda.');
    }

    private function normalizeRole(string $role): string
    {
        return match (strtolower($role)) {
            'guru' => 'teacher',
            'siswa' => 'student',
            default => strtolower($role),
        };
    }
}