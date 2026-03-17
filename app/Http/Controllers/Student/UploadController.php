<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function index()
    {
        return view('student.upload');
    }

    public function store(Request $request)
    {
        // Validate the file upload
        $validated = $request->validate([
            'file' => 'required|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:5120'
        ]);

        // Handle file storage
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $path = $file->store('student-uploads', 'public');
            
            // You can save the file reference to database here if needed
            
            return redirect()->route('student.upload')->with('success', 'File uploaded successfully.');
        }

        return back()->with('error', 'File upload failed.');
    }
}
