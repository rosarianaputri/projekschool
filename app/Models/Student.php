<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;

class Student extends Model
{
    use HasFactory;

    protected $table = 'ppdb_applications';

    protected $fillable = [
        'user_id',
        'student_name',
        'gender',
        'birth_place',
        'birth_date',
        'previous_school',
        'parent_name',
        'phone',
        'email',
        'address',
        'status',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}