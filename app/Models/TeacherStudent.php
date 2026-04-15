<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherStudent extends Model
{
    use HasFactory;

    protected $fillable = [
        'teacher_class_id',
        'name',
        'email',
        'phone',
        'nis',
        'notes',
    ];

    public function class()
    {
        return $this->belongsTo(TeacherClass::class, 'teacher_class_id');
    }
}