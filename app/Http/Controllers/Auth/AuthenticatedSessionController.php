<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\LoginActivity;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Tampilkan halaman login universal
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Proses login universal
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
     * Logout user
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    private function recordLoginActivity(Request $request, User $user): void
    {
        if (! Schema::hasTable('login_activities')) {
            return;
        }

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