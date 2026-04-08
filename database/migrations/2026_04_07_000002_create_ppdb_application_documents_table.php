<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ppdb_application_documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ppdb_application_id')->constrained('ppdb_applications')->cascadeOnDelete();
            $table->string('document_type', 50);
            $table->string('original_name');
            $table->string('file_path');
            $table->string('mime_type', 100)->nullable();
            $table->unsignedBigInteger('file_size')->default(0);
            $table->timestamps();

            $table->unique(['ppdb_application_id', 'document_type'], 'ppdb_doc_unique_type_per_application');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ppdb_application_documents');
    }
};
