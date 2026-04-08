<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\TeacherClass;

class TeacherStudent extends Model
{
    use HasFactory;

    protected $fillable = [
        'teacher_id',
        'teacher_class_id',
        'name',
        'nis',
        'phone',
        'email',
        'notes',
    ];

    public function class(): BelongsTo
    {
        return $this->belongsTo(TeacherClass::class, 'teacher_class_id');
    }
}
