<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherClass extends Model
{
    use HasFactory;

    protected $table = 'teacher_classes';

    protected $fillable = [
        'teacher_id',
        'name',
        'subject',
        'semester',
        'room',
        'schedule',
    ];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function students()
    {
        return $this->hasMany(TeacherStudent::class, 'teacher_class_id');
    }

    public function materials()
    {
        return $this->hasMany(TeacherMaterial::class, 'teacher_class_id');
    }

    public function schedules()
    {
        return $this->hasMany(TeacherSchedule::class, 'teacher_class_id');
    }

    public function grades()
    {
        return $this->hasMany(TeacherGrade::class, 'teacher_class_id');
    }

    public function assignments()
    {
        return $this->hasMany(TeacherAssignment::class, 'teacher_class_id');
    }

    public function attendances()
    {
        return $this->hasMany(TeacherAttendance::class, 'teacher_class_id');
    }
}