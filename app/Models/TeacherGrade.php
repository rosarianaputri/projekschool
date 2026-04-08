<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\TeacherClass;

class TeacherGrade extends Model
{
    use HasFactory;

    protected $fillable = [
        'teacher_class_id',
        'student_name',
        'category',
        'score',
        'note',
    ];

    public function class(): BelongsTo
    {
        return $this->belongsTo(TeacherClass::class, 'teacher_class_id');
    }
}
