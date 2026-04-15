<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PpdbApplication extends Model
{
    use HasFactory;

    protected $fillable = [
        'registration_code',
        'student_name',
        'gender',
        'birth_place',
        'birth_date',
        'previous_school',
        'parent_name',
        'phone',
        'address',
        'email',
        'notes',
        'status',
        'teacher_class_id',
    ];

    protected $casts = [
        'birth_date' => 'date',
    ];

    public function documents()
    {
        return $this->hasMany(PpdbDocument::class, 'ppdb_application_id');
    }

    public function teacherClass()
    {
        return $this->belongsTo(TeacherClass::class, 'teacher_class_id');
    }

    public function documentSummary(): array
    {
        $documents = $this->documents ?? collect();

        $requiredTypes = [
            'akta_kelahiran',
            'ktp_orang_tua',
            'rapor',
        ];

        $uploadedRequired = $documents
            ->whereIn('document_type', $requiredTypes)
            ->count();

        return [
            'required_total' => count($requiredTypes),
            'uploaded_required' => $uploadedRequired,
            'is_complete' => $uploadedRequired >= count($requiredTypes),
        ];
    }
}