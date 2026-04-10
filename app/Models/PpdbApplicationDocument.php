<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PpdbApplicationDocument extends Model
{
    use HasFactory;

    public const REQUIRED_DOCUMENTS = [
        'birth_certificate' => 'Fotokopi akta kelahiran',
        'parent_id_card' => 'Fotokopi KTP orang tua',
        'report_card' => 'Raport 2 tahun terakhir',
        'health_certificate' => 'Surat keterangan sehat',
    ];

    public const OPTIONAL_DOCUMENTS = [
        'achievement_certificate' => 'Sertifikat prestasi',
    ];

    protected $fillable = [
        'ppdb_application_id',
        'document_type',
        'original_name',
        'file_path',
        'mime_type',
        'file_size',
    ];

    public function application(): BelongsTo
    {
        return $this->belongsTo(PpdbApplication::class, 'ppdb_application_id');
    }

    public static function allDocumentLabels(): array
    {
        return self::REQUIRED_DOCUMENTS + self::OPTIONAL_DOCUMENTS;
    }
}
