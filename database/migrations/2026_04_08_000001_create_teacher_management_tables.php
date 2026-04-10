<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('teacher_classes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('teacher_id')->nullable();
            $table->foreign('teacher_id')->references('id')->on('teachers')->onDelete('cascade');
            $table->string('name');
            $table->string('subject');
            $table->string('semester')->nullable();
            $table->string('schedule')->nullable();
            $table->string('room')->nullable();
            $table->timestamps();
        });

        Schema::create('teacher_students', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('teacher_id')->nullable();
            $table->foreign('teacher_id')->references('id')->on('teachers')->onDelete('cascade');
            $table->unsignedBigInteger('teacher_class_id')->nullable();
            $table->foreign('teacher_class_id')->references('id')->on('teacher_classes')->onDelete('cascade');
            $table->string('name');
            $table->string('nis')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });

        Schema::create('teacher_assignments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('teacher_class_id')->nullable();
            $table->foreign('teacher_class_id')->references('id')->on('teacher_classes')->onDelete('cascade');
            $table->string('title');
            $table->text('description')->nullable();
            $table->date('due_date')->nullable();
            $table->string('status')->default('draft');
            $table->timestamps();
        });

        Schema::create('teacher_materials', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('teacher_class_id')->nullable();
            $table->foreign('teacher_class_id')->references('id')->on('teacher_classes')->onDelete('cascade');
            $table->string('title');
            $table->string('type')->nullable();
            $table->string('link')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });

        Schema::create('teacher_schedules', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('teacher_class_id')->nullable();
            $table->foreign('teacher_class_id')->references('id')->on('teacher_classes')->onDelete('cascade');
            $table->string('day')->nullable();
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();
            $table->string('room')->nullable();
            $table->timestamps();
        });

        Schema::create('teacher_attendances', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('teacher_class_id')->nullable();
            $table->foreign('teacher_class_id')->references('id')->on('teacher_classes')->onDelete('cascade');
            $table->date('date');
            $table->unsignedInteger('present')->default(0);
            $table->unsignedInteger('permission')->default(0);
            $table->unsignedInteger('sick')->default(0);
            $table->unsignedInteger('absent')->default(0);
            $table->text('note')->nullable();
            $table->timestamps();
        });

        Schema::create('teacher_grades', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('teacher_class_id')->nullable();
            $table->foreign('teacher_class_id')->references('id')->on('teacher_classes')->onDelete('cascade');
            $table->string('student_name');
            $table->string('category')->nullable();
            $table->unsignedInteger('score')->nullable();
            $table->text('note')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('teacher_grades');
        Schema::dropIfExists('teacher_attendances');
        Schema::dropIfExists('teacher_schedules');
        Schema::dropIfExists('teacher_materials');
        Schema::dropIfExists('teacher_assignments');
        Schema::dropIfExists('teacher_students');
        Schema::dropIfExists('teacher_classes');
    }
};
