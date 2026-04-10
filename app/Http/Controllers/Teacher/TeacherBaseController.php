<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Teacher;

class TeacherBaseController extends Controller
{
    protected function currentTeacher(): Teacher
    {
        $teacher = auth()->user()->teacher;
        abort_unless($teacher, 403);

        return $teacher;
    }

    protected function currentTeacherId(): int
    {
        return $this->currentTeacher()->id;
    }
}
