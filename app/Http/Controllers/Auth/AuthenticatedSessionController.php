<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
     * Proses login user
     */
    public function store(LoginRequest $request): RedirectResponse
{
    // Autentikasi user
    $request->authenticate();

    // Regenerate session
    $request->session()->regenerate();

    $user = Auth::user();

    // Redirect berdasarkan role
    if ($user->role === 'admin') {
        return redirect()->intended('/admin/home');
    }

    if ($user->role === 'teacher') {
        return redirect()->intended('/teacher/dashboard');
    }

    if ($user->role === 'student') {
        return redirect()->intended('/student/dashboard');
    }

    // default fallback
    return redirect('/');
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
}