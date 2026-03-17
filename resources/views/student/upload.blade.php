@extends('layouts.student')

@section('content')

<div class="nxl-content-right">
    <div class="nxl-content-inner" style="padding-top: 30px; padding-left: 30px; padding-right: 30px;">
        <!-- Page Header -->
        <div class="nxl-head mb-4">
            <div class="nxl-head-content">
                <h2 class="nxl-title mb-1">
                    <i class="feather-upload-cloud me-2"></i>Upload Berkas Persyaratan
                </h2>
                <p class="nxl-head-text">Unggah dokumen yang diperlukan untuk melengkapi pendaftaran Anda</p>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8">
                <div class="card border-0">
                    <div class="card-body">
                        {{-- Display success message --}}
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="feather-check-circle me-2"></i>
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        {{-- Display error message --}}
                        @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="feather-alert-triangle me-2"></i>
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <form action="{{ route('student.upload.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="mb-4">
                                <label for="file" class="form-label fw-600 text-dark">Pilih File</label>
                                <div class="upload-area border-2 border-dashed rounded-3 p-5 text-center @error('file') border-danger @else border-primary @enderror" id="upload-area">
                                    <i class="feather-upload-cloud fs-40 text-primary mb-3 d-block"></i>
                                    <h6 class="text-dark mb-2">Drag & drop file di sini atau klik untuk memilih</h6>
                                    <p class="text-muted small mb-0">Format: PDF, DOC, DOCX, JPG, PNG | Maksimal 5MB</p>
                                    <input class="form-control d-none" type="file" id="file" name="file" 
                                           accept=".pdf,.doc,.docx,.jpg,.jpeg,.png" required>
                                </div>
                                
                                <div id="file-info" class="mt-3" style="display: none;">
                                    <div class="alert alert-info mb-0">
                                        <i class="feather-info me-2"></i>
                                        File dipilih: <strong id="file-name"></strong>
                                    </div>
                                </div>

                                @error('file')
                                    <div class="invalid-feedback d-block mt-2">
                                        <i class="feather-alert-triangle me-1"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <hr>

                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary">
                                    <i class="feather-upload me-2"></i>Upload Berkas
                                </button>
                                <a href="{{ route('student.dashboard') }}" class="btn btn-secondary">
                                    <i class="feather-arrow-left me-2"></i>Kembali
                                </a>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Requirements Info Card -->
                <div class="card border-0 mt-4">
                    <div class="card-header bg-light border-0">
                        <h6 class="mb-0 text-dark">
                            <i class="feather-info me-2 text-info"></i>Berkas yang Diperlukan
                        </h6>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled">
                            <li class="mb-2">
                                <i class="feather-check text-success me-2"></i>
                                <span class="text-muted">Fotokopi akta kelahiran (PDF/JPG)</span>
                            </li>
                            <li class="mb-2">
                                <i class="feather-check text-success me-2"></i>
                                <span class="text-muted">Fotokopi KTP orang tua (PDF/JPG)</span>
                            </li>
                            <li class="mb-2">
                                <i class="feather-check text-success me-2"></i>
                                <span class="text-muted">Raport 2 tahun terakhir (PDF)</span>
                            </li>
                            <li class="mb-2">
                                <i class="feather-check text-success me-2"></i>
                                <span class="text-muted">Sertifikat prestasi (PDF/JPG) - jika ada</span>
                            </li>
                            <li>
                                <i class="feather-check text-success me-2"></i>
                                <span class="text-muted">Surat keterangan sehat (PDF)</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Side Info -->
            <div class="col-lg-4">
                <div class="card border-0 bg-light-primary">
                    <div class="card-body text-center">
                        <i class="feather-alert-circle fs-40 text-primary mb-3 d-block"></i>
                        <h6 class="text-dark mb-3">Perhatian!</h6>
                        <p class="small text-muted mb-0">Pastikan semua berkas yang Anda unggah sudah jelas dan sesuai dengan persyaratan. Unggahan yang tidak sesuai mungkin ditolak.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .upload-area {
        cursor: pointer;
        transition: all 0.3s ease;
    }
    
    .upload-area:hover {
        background-color: rgba(88, 99, 255, 0.05);
        border-color: #5863ff !important;
    }
    
    .bg-light-primary {
        background-color: rgba(88, 99, 255, 0.1);
    }
</style>

<script>
    const uploadArea = document.getElementById('upload-area');
    const fileInput = document.getElementById('file');
    const fileInfo = document.getElementById('file-info');
    const fileName = document.getElementById('file-name');

    // Click to upload
    uploadArea.addEventListener('click', () => fileInput.click());

    // Drag and drop
    uploadArea.addEventListener('dragover', (e) => {
        e.preventDefault();
        uploadArea.style.backgroundColor = 'rgba(88, 99, 255, 0.1)';
    });

    uploadArea.addEventListener('dragleave', () => {
        uploadArea.style.backgroundColor = '';
    });

    uploadArea.addEventListener('drop', (e) => {
        e.preventDefault();
        uploadArea.style.backgroundColor = '';
        
        const files = e.dataTransfer.files;
        if (files.length > 0) {
            fileInput.files = files;
            updateFileName();
        }
    });

    // File input change
    fileInput.addEventListener('change', updateFileName);

    function updateFileName() {
        if (fileInput.files.length > 0) {
            fileName.textContent = fileInput.files[0].name;
            fileInfo.style.display = 'block';
        } else {
            fileInfo.style.display = 'none';
        }
    }
</script>

@endsection
