<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register-portal');
    }

    /**
     * Display role based registration view.
     */
    public function createRoleRegister(string $role): View
    {
        $normalizedRole = $this->normalizeRole($role);

        if (! in_array($normalizedRole, ['student'], true)) {
            abort(404);
        }

        return view('auth.register', [
            'role' => $normalizedRole,
            'roleLabel' => $this->roleLabel($normalizedRole),
            'submitRoute' => route('register.role.store', $role),
        ]);
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        return $this->registerByRole($request, 'student');
    }

    /**
     * Handle registration for specific role.
     */
    public function storeRoleRegister(Request $request, string $role): RedirectResponse
    {
        $normalizedRole = $this->normalizeRole($role);

        if (! in_array($normalizedRole, ['student'], true)) {
            abort(404);
        }

        return $this->registerByRole($request, $normalizedRole);
    }

    private function registerByRole(Request $request, string $role): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $role,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect($user->dashboardPath());
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
            'teacher' => 'Guru',
            'student' => 'Siswa',
            default => ucfirst($role),
        };
    }
}