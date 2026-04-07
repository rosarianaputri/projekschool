<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
        'email',
        'address',
        'notes',
        'status',
        'approved_at',
        'approved_by',
    ];

    protected function casts(): array
    {
        return [
            'birth_date' => 'date',
            'approved_at' => 'datetime',
        ];
    }

    public function approver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function documents(): HasMany
    {
        return $this->hasMany(PpdbApplicationDocument::class, 'ppdb_application_id');
    }

    public function documentSummary(): array
    {
        $requiredTypes = array_keys(PpdbApplicationDocument::REQUIRED_DOCUMENTS);
        $uploadedTypes = $this->documents
            ->pluck('document_type')
            ->unique()
            ->values()
            ->all();

        $missingTypes = array_values(array_diff($requiredTypes, $uploadedTypes));

        return [
            'required_total' => count($requiredTypes),
            'uploaded_required' => count($requiredTypes) - count($missingTypes),
            'missing_types' => $missingTypes,
            'is_complete' => count($missingTypes) === 0,
        ];
    }
}
