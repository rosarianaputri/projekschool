<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;

class ClassController extends Controller
{
    public function index()
    {
        return view('teacher.classes.index');
    }
}