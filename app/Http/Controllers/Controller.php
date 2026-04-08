<?php

namespace App\Http\Controllers;

abstract class Controller
{
    /**
     * Normalize role name (e.g., 'guru' -> 'teacher', 'siswa' -> 'student')
     */
    protected function normalizeRole(string $role): string
    {
        return match (strtolower($role)) {
            'guru' => 'teacher',
            'siswa' => 'student',
            default => strtolower($role),
        };
    }

    /**
     * Get human-readable role label
     */
    protected function roleLabel(string $role): string
    {
        return match ($role) {
            'admin' => 'Admin',
            'teacher' => 'Guru',
            'student' => 'Siswa',
            default => ucfirst($role),
        };
    }
}
