<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\LoginActivity;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Tampilkan halaman login
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Tampilkan halaman login sesuai role.
     */
    public function createRoleLogin(string $role): View
    {
        $normalizedRole = $this->normalizeRole($role);

        if (! in_array($normalizedRole, ['admin', 'teacher', 'student'], true)) {
            abort(404);
        }

        return view('auth.login-role', [
            'role' => $normalizedRole,
            'roleLabel' => $this->roleLabel($normalizedRole),
        ]);
    }

    /**
     * Proses login user
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();
        $request->session()->regenerate();

        /** @var User $user */
        $user = Auth::user();
        $this->recordLoginActivity($request, $user);

        return redirect()->intended($user->dashboardPath());
    }

    /**
     * Proses login user berdasarkan portal role yang dipilih.
     */
    public function storeRoleLogin(LoginRequest $request, string $role): RedirectResponse
    {
        $expectedRole = $this->normalizeRole($role);

        if (! in_array($expectedRole, ['admin', 'teacher', 'student'], true)) {
            throw ValidationException::withMessages([
                'email' => 'Role login tidak valid.',
            ]);
        }

        $candidateUser = User::query()
            ->where('email', (string) $request->string('email'))
            ->first();

        if ($candidateUser && $this->normalizeRole((string) $candidateUser->role) !== $expectedRole) {
            throw ValidationException::withMessages([
                'email' => 'Akun ini bukan untuk portal '.$this->roleLabel($expectedRole).'.',
            ]);
        }

        $request->authenticate();
        $request->session()->regenerate();

        /** @var User $user */
        $user = Auth::user();
        $this->recordLoginActivity($request, $user);

        return redirect()->intended($user->dashboardPath());
    }

    /**
     * Logout user
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    private function normalizeRole(string $role): string
    {
        return match (strtolower($role)) {
            'guru' => 'teacher',
            'siswa' => 'student',
            default => strtolower($role),
        };
    }

    private function roleLabel(string $role): string
    {
        return match ($role) {
            'admin' => 'Admin',
            'teacher' => 'Guru',
            'student' => 'Siswa',
            default => ucfirst($role),
        };
    }

    private function recordLoginActivity(Request $request, User $user): void
    {
        LoginActivity::create([
            'user_id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'role' => strtolower((string) $user->role),
            'ip_address' => $request->ip(),
            'user_agent' => (string) $request->userAgent(),
            'logged_in_at' => now(),
        ]);
    }
}