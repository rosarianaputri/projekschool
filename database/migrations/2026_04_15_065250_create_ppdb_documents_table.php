<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('ppdb_documents', function (Blueprint $table) {
        $table->id();
        $table->foreignId('ppdb_application_id')->constrained()->cascadeOnDelete();
        $table->string('document_type');
        $table->string('file_path');
        $table->string('original_name')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ppdb_documents');
    }
};
