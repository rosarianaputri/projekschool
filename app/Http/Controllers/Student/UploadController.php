<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\PpdbApplication;
use App\Models\PpdbApplicationDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
    public function index(Request $request)
    {
        $application = PpdbApplication::query()
            ->where('email', $request->user()->email)
            ->with('documents')
            ->first();

        $documentSummary = $application?->documentSummary();

        return view('student.upload', [
            'application' => $application,
            'requiredDocuments' => PpdbApplicationDocument::REQUIRED_DOCUMENTS,
            'optionalDocuments' => PpdbApplicationDocument::OPTIONAL_DOCUMENTS,
            'uploadedTypes' => $application
                ? $application->documents->pluck('document_type')->unique()->values()->all()
                : [],
            'documentSummary' => $documentSummary,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'document_type' => ['required', 'string', 'in:' . implode(',', array_keys(PpdbApplicationDocument::allDocumentLabels()))],
            'file' => 'required|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:5120',
        ]);

        $application = PpdbApplication::query()
            ->where('email', $request->user()->email)
            ->with('documents')
            ->first();

        if (!$application) {
            return redirect()
                ->route('student.formulir')
                ->with('error', 'Silakan isi formulir pendaftaran terlebih dahulu sebelum upload berkas.');
        }

        if (!$request->hasFile('file')) {
            return back()->with('error', 'File upload gagal.');
        }

        $file = $request->file('file');
        $path = $file->store('student-uploads/' . $application->id, 'public');
        $existingDocument = $application->documents
            ->firstWhere('document_type', $validated['document_type']);

        if ($existingDocument && Storage::disk('public')->exists($existingDocument->file_path)) {
            Storage::disk('public')->delete($existingDocument->file_path);
        }

        PpdbApplicationDocument::updateOrCreate(
            [
                'ppdb_application_id' => $application->id,
                'document_type' => $validated['document_type'],
            ],
            [
                'original_name' => (string) $file->getClientOriginalName(),
                'file_path' => $path,
                'mime_type' => (string) $file->getClientMimeType(),
                'file_size' => (int) $file->getSize(),
            ]
        );

        $application->load('documents');
        $summary = $application->documentSummary();

        return redirect()
            ->route('student.upload')
            ->with('success', 'Berkas berhasil diupload. Tersimpan di folder storage/app/public/' . $path)
            ->with('document_status', $summary['is_complete'] ? 'complete' : 'incomplete');
    }
}
