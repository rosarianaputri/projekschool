<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        // default step
        $step = 0;

        // cek apakah siswa sudah punya kelas
        $studentClass = \DB::table('teacher_students')
            ->where('email', $user->email)
            ->first();

        // cek apakah sudah daftar PPDB
        $ppdb = \DB::table('ppdb_applications')
            ->where('email', $user->email)
            ->first();

        // LOGIC STEP (biar dashboard dinamis)
        if (!$ppdb) {
            $step = 1; // belum daftar PPDB
        } elseif (!$studentClass) {
            $step = 2; // belum masuk kelas
        } else {
            $step = 0; // sudah lengkap
        }

        return view('student.dashboard', compact('step'));
    }
}

