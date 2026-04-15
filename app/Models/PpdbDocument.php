<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PpdbDocument extends Model
{
    use HasFactory;

    protected $fillable = [
        'ppdb_application_id',
        'document_type',
        'file_path',
        'original_name',
    ];

    public function application()
    {
        return $this->belongsTo(PpdbApplication::class, 'ppdb_application_id');
    }
}