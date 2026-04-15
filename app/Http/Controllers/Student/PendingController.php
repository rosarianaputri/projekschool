<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PendingController extends Controller
{
    public function index(Request $request)
    {
        return view('student.pending', [
            'user' => $request->user(),
        ]);
    }
}