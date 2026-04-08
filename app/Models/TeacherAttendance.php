<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\TeacherClass;

class TeacherAttendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'teacher_class_id',
        'date',
        'present',
        'permission',
        'sick',
        'absent',
        'note',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    public function class(): BelongsTo
    {
        return $this->belongsTo(TeacherClass::class, 'teacher_class_id');
    }
}
