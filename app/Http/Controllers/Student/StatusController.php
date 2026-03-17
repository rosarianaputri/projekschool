<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\PpdbApplication;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $application = PpdbApplication::where('email', $user->email)->first();
        
        return view('student.status', compact('application'));
    }
}
