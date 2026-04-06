<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Validation\ValidationException;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    protected static function booted(): void
    {
        static::saving(function (User $user): void {
            if (strtolower((string) $user->role) !== 'admin') {
                return;
            }

            $existingAdminExists = static::query()
                ->whereRaw('LOWER(role) = ?', ['admin'])
                ->when($user->exists, function ($query) use ($user) {
                    $query->where('id', '!=', $user->id);
                })
                ->exists();

            if ($existingAdminExists) {
                throw ValidationException::withMessages([
                    'role' => 'Akun admin hanya boleh 1 orang.',
                ]);
            }
        });
    }

    public function dashboardPath(): string
    {
        return match (strtolower((string) $this->role)) {
            'admin' => '/admin/home',
            'guru',
            'teacher' => '/teacher/dashboard',
            'siswa',
            'student' => '/student/dashboard',
            default => '/home',
        };
    }
}
