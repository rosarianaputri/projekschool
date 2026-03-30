<?php
 namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle(Request $request, Closure $next, $role)
    {
        if (! Auth::check()) {
            abort(403);
        }

        $expectedRole = $this->normalizeRole((string) $role);
        $actualRole = $this->normalizeRole((string) Auth::user()->role);

        if ($expectedRole === $actualRole) {
            return $next($request);
        }

        abort(403);
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
