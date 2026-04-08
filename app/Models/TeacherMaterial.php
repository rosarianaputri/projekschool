<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\TeacherClass;

class TeacherMaterial extends Model
{
    use HasFactory;

    protected $fillable = [
        'teacher_class_id',
        'title',
        'type',
        'link',
        'notes',
    ];

    public function class(): BelongsTo
    {
        return $this->belongsTo(TeacherClass::class, 'teacher_class_id');
    }
}
