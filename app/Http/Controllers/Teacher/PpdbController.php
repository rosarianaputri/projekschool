<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\PpdbApplication;
use App\Models\PpdbApplicationDocument;
use Illuminate\View\View;

class PpdbController extends Controller
{
    public function index()
    {
        return redirect()->route('teacher.dashboard');
    }

    public function show(PpdbApplication $ppdbApplication): View
    {
        $application = $ppdbApplication->load('documents');

        return view('teacher.ppdb.show', [
            'application' => $application,
            'documentSummary' => $application->documentSummary(),
            'documentLabels' => PpdbApplicationDocument::allDocumentLabels(),
        ]);
    }
}
