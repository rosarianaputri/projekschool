<?php

namespace App\Models;

use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'status',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
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

    public function teacher()
    {
        return $this->hasOne(Teacher::class);
    }

    public function student()
    {
        return $this->hasOne(Student::class);
    }

    public function isApproved(): bool
    {
        return strtolower((string) $this->status) === 'approved';
    }

    public function isPending(): bool
    {
        return strtolower((string) $this->status) === 'pending';
    }

    public function isRejected(): bool
    {
        return strtolower((string) $this->status) === 'rejected';
    }
}