<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherGrade extends Model
{
    use HasFactory;

    protected $table = 'teacher_grades';

    protected $fillable = [
        'teacher_class_id',
        'student_name',
        'student_id',
        'assignment_score',
        'mid_score',
        'final_score',
        'notes',
    ];

    public function teacherClass()
    {
        return $this->belongsTo(TeacherClass::class, 'teacher_class_id');
    }
}