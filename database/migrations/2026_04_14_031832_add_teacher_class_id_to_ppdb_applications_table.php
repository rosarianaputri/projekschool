<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('ppdb_applications', function (Blueprint $table) {
            if (!Schema::hasColumn('ppdb_applications', 'teacher_class_id')) {
                $table->foreignId('teacher_class_id')->nullable()->constrained('teacher_classes')->nullOnDelete();
            }
        });
    }

    public function down(): void
    {
        Schema::table('ppdb_applications', function (Blueprint $table) {
            if (Schema::hasColumn('ppdb_applications', 'teacher_class_id')) {
                $table->dropConstrainedForeignId('teacher_class_id');
            }
        });
    }
};