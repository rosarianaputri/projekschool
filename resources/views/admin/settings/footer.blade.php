@extends('layouts.admin')

@section('title', 'Footer Settings')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h1 class="h3 mb-1">Footer Settings</h1>
                    <p class="text-muted mb-0">Edit semua section footer frontend dan lihat data yang sedang aktif.</p>
                </div>
                <a href="{{ route('front.home') }}" target="_blank" class="btn btn-outline-primary btn-sm">
                    <i class="fas fa-external-link-alt me-1"></i> Preview Website
                </a>
            </div>

            @if(session('status'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    @switch(session('status'))
                        @case('footer_reset')
                            Footer berhasil di-reset ke data default.
                            @break
                        @case('footer_deleted')
                            Footer berhasil dihapus dari data custom.
                            @break
                        @default
                            Footer berhasil diperbarui.
                    @endswitch
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="card mb-4 border-0 shadow-sm">
                <div class="card-header bg-white border-0 pb-0">
                    <h5 class="mb-1">Data Footer Saat Ini</h5>
                    <p class="text-muted mb-0 small">
                        {{ $hasStoredData ? 'Menampilkan data custom yang sedang dipakai di frontend.' : 'Belum ada data custom. Footer frontend masih memakai data default.' }}
                    </p>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-lg-4">
                            <div class="preview-box h-100">
                                <div class="preview-label">School Info</div>
                                <h4 class="mb-2">{{ $data['brand_name'] }}</h4>
                                <p class="text-muted mb-3">{{ $data['brand_description'] }}</p>
                                <p class="mb-1"><i class="fas fa-map-marker-alt text-primary me-2"></i>{!! nl2br(e($data['address'])) !!}</p>
                                <p class="mb-1"><i class="fas fa-envelope text-primary me-2"></i>{{ $data['email'] }}</p>
                                <p class="mb-0"><i class="fas fa-phone text-primary me-2"></i>{{ $data['phone'] }}</p>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="preview-box h-100">
                                <div class="preview-label">Section Summary</div>
                                <p class="mb-2"><strong>{{ $data['quick_links_title'] }}</strong> ({{ count($data['quick_links']) }} links)</p>
                                <p class="mb-2"><strong>{{ $data['programs_title'] }}</strong> ({{ count($data['programs']) }} items)</p>
                                <p class="mb-2"><strong>{{ $data['social_title'] }}</strong> ({{ count($data['social_links']) }} links)</p>
                                <p class="mb-0"><strong>Newsletter</strong>: {{ $data['newsletter_enabled'] === '1' ? 'Aktif' : 'Nonaktif' }}</p>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="preview-box h-100">
                                <div class="preview-label">Map Preview</div>
                                <div class="ratio ratio-4x3 overflow-hidden rounded-3 border">
                                    <iframe src="{{ $data['map_embed_url'] }}" style="border:0;" loading="lazy"></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <form method="POST" action="{{ route('admin.settings.footer.update') }}">
                @csrf

                <div class="card mb-4 border-0 shadow-sm">
                    <div class="card-header bg-white">
                        <h5 class="mb-0">School Info</h5>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Nama Sekolah</label>
                                <input type="text" name="brand_name" class="form-control" value="{{ $data['brand_name'] }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Email</label>
                                <input type="text" name="email" class="form-control" value="{{ $data['email'] }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Telepon</label>
                                <input type="text" name="phone" class="form-control" value="{{ $data['phone'] }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Google Maps Embed URL</label>
                                <input type="text" name="map_embed_url" class="form-control" value="{{ $data['map_embed_url'] }}">
                            </div>
                            <div class="col-12">
                                <label class="form-label">Deskripsi</label>
                                <textarea name="brand_description" rows="3" class="form-control">{{ $data['brand_description'] }}</textarea>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Alamat</label>
                                <textarea name="address" rows="3" class="form-control">{{ $data['address'] }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mb-4 border-0 shadow-sm">
                    <div class="card-header bg-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Quick Links</h5>
                        <button type="button" class="btn btn-outline-primary btn-sm add-row" data-target="quick-links-container" data-type="quick-link">
                            <i class="fas fa-plus me-1"></i> Add Link
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Judul Section</label>
                            <input type="text" name="quick_links_title" class="form-control" value="{{ $data['quick_links_title'] }}">
                        </div>
                        <div id="quick-links-container" class="row g-3">
                            @foreach($data['quick_links'] as $index => $item)
                                <div class="col-12 repeater-item" data-type="quick-link">
                                    <div class="border rounded-3 p-3 bg-light-subtle">
                                        <div class="row g-2 align-items-end">
                                            <div class="col-md-5">
                                                <label class="form-label">Label</label>
                                                <input type="text" name="quick_links[{{ $index }}][label]" class="form-control" value="{{ $item['label'] }}">
                                            </div>
                                            <div class="col-md-5">
                                                <label class="form-label">URL</label>
                                                <input type="text" name="quick_links[{{ $index }}][url]" class="form-control" value="{{ $item['url'] }}">
                                            </div>
                                            <div class="col-md-2 d-grid">
                                                <button type="button" class="btn btn-outline-danger remove-row">Hapus</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="card mb-4 border-0 shadow-sm">
                    <div class="card-header bg-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Programs</h5>
                        <button type="button" class="btn btn-outline-primary btn-sm add-row" data-target="programs-container" data-type="program">
                            <i class="fas fa-plus me-1"></i> Add Program
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Judul Section</label>
                            <input type="text" name="programs_title" class="form-control" value="{{ $data['programs_title'] }}">
                        </div>
                        <div id="programs-container" class="row g-3">
                            @foreach($data['programs'] as $index => $item)
                                <div class="col-12 repeater-item" data-type="program">
                                    <div class="border rounded-3 p-3 bg-light-subtle">
                                        <div class="row g-2 align-items-end">
                                            <div class="col-md-4">
                                                <label class="form-label">Label</label>
                                                <input type="text" name="programs[{{ $index }}][label]" class="form-control" value="{{ $item['label'] }}">
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label">URL</label>
                                                <input type="text" name="programs[{{ $index }}][url]" class="form-control" value="{{ $item['url'] }}">
                                            </div>
                                            <div class="col-md-2">
                                                <label class="form-label">Icon</label>
                                                <input type="text" name="programs[{{ $index }}][icon]" class="form-control" value="{{ $item['icon'] }}">
                                            </div>
                                            <div class="col-md-2 d-grid">
                                                <button type="button" class="btn btn-outline-danger remove-row">Hapus</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="card mb-4 border-0 shadow-sm">
                    <div class="card-header bg-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Social Media</h5>
                        <button type="button" class="btn btn-outline-primary btn-sm add-row" data-target="social-links-container" data-type="social-link">
                            <i class="fas fa-plus me-1"></i> Add Social Link
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Judul Section</label>
                                <input type="text" name="social_title" class="form-control" value="{{ $data['social_title'] }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Deskripsi Section</label>
                                <input type="text" name="social_description" class="form-control" value="{{ $data['social_description'] }}">
                            </div>
                        </div>
                        <div id="social-links-container" class="row g-3">
                            @foreach($data['social_links'] as $index => $item)
                                <div class="col-12 repeater-item" data-type="social-link">
                                    <div class="border rounded-3 p-3 bg-light-subtle">
                                        <div class="row g-2 align-items-end">
                                            <div class="col-md-3">
                                                <label class="form-label">Platform</label>
                                                <input type="text" name="social_links[{{ $index }}][platform]" class="form-control" value="{{ $item['platform'] }}">
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label">URL</label>
                                                <input type="text" name="social_links[{{ $index }}][url]" class="form-control" value="{{ $item['url'] }}">
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label">Icon</label>
                                                <input type="text" name="social_links[{{ $index }}][icon]" class="form-control" value="{{ $item['icon'] }}">
                                            </div>
                                            <div class="col-md-2 d-grid">
                                                <button type="button" class="btn btn-outline-danger remove-row">Hapus</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="card mb-4 border-0 shadow-sm">
                    <div class="card-header bg-white">
                        <h5 class="mb-0">Newsletter</h5>
                    </div>
                    <div class="card-body">
                        <div class="form-check form-switch mb-3">
                            <input class="form-check-input" type="checkbox" role="switch" id="newsletter_enabled" name="newsletter_enabled" value="1" {{ $data['newsletter_enabled'] === '1' ? 'checked' : '' }}>
                            <label class="form-check-label" for="newsletter_enabled">Aktifkan newsletter form</label>
                        </div>
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label">Judul Newsletter</label>
                                <input type="text" name="newsletter_title" class="form-control" value="{{ $data['newsletter_title'] }}">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Placeholder Input</label>
                                <input type="text" name="newsletter_placeholder" class="form-control" value="{{ $data['newsletter_placeholder'] }}">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Teks Tombol</label>
                                <input type="text" name="newsletter_button_text" class="form-control" value="{{ $data['newsletter_button_text'] }}">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mb-4 border-0 shadow-sm">
                    <div class="card-header bg-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Bottom Bar</h5>
                        <button type="button" class="btn btn-outline-primary btn-sm add-row" data-target="bottom-links-container" data-type="bottom-link">
                            <i class="fas fa-plus me-1"></i> Add Bottom Link
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Copyright Text</label>
                            <input type="text" name="bottom_copyright" class="form-control" value="{{ $data['bottom_copyright'] }}">
                            <small class="text-muted">Gunakan <code>{year}</code> bila ingin tahun otomatis.</small>
                        </div>
                        <div id="bottom-links-container" class="row g-3">
                            @foreach($data['bottom_links'] as $index => $item)
                                <div class="col-12 repeater-item" data-type="bottom-link">
                                    <div class="border rounded-3 p-3 bg-light-subtle">
                                        <div class="row g-2 align-items-end">
                                            <div class="col-md-5">
                                                <label class="form-label">Label</label>
                                                <input type="text" name="bottom_links[{{ $index }}][label]" class="form-control" value="{{ $item['label'] }}">
                                            </div>
                                            <div class="col-md-5">
                                                <label class="form-label">URL</label>
                                                <input type="text" name="bottom_links[{{ $index }}][url]" class="form-control" value="{{ $item['url'] }}">
                                            </div>
                                            <div class="col-md-2 d-grid">
                                                <button type="button" class="btn btn-outline-danger remove-row">Hapus</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2 pb-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i> Save Changes
                    </button>
                    <button type="submit" form="footer-reset-form" class="btn btn-warning" onclick="return confirm('Reset footer ke data default?')">
                        <i class="fas fa-undo me-1"></i> Reset
                    </button>
                    <button type="submit" form="footer-delete-form" class="btn btn-danger" onclick="return confirm('Hapus semua data custom footer?')">
                        <i class="fas fa-trash me-1"></i> Delete
                    </button>
                    <a href="{{ route('dashboard') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>

            <form id="footer-reset-form" method="POST" action="{{ route('admin.settings.footer.reset') }}" class="d-none">
                @csrf
            </form>

            <form id="footer-delete-form" method="POST" action="{{ route('admin.settings.footer.destroy') }}" class="d-none">
                @csrf
                @method('DELETE')
            </form>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.preview-box {
    border: 1px solid #e9ecef;
    border-radius: 16px;
    padding: 1rem;
    background: linear-gradient(180deg, #ffffff 0%, #f8fbff 100%);
}

.preview-label {
    display: inline-block;
    margin-bottom: 0.75rem;
    padding: 0.25rem 0.65rem;
    border-radius: 999px;
    background: #edf4ff;
    color: #2251cc;
    font-size: 0.75rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.04em;
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const counters = {
        'quick-link': {{ count($data['quick_links']) }},
        'program': {{ count($data['programs']) }},
        'social-link': {{ count($data['social_links']) }},
        'bottom-link': {{ count($data['bottom_links']) }},
    };

    const templates = {
        'quick-link': (index) => `
            <div class="col-12 repeater-item" data-type="quick-link">
                <div class="border rounded-3 p-3 bg-light-subtle">
                    <div class="row g-2 align-items-end">
                        <div class="col-md-5">
                            <label class="form-label">Label</label>
                            <input type="text" name="quick_links[${index}][label]" class="form-control">
                        </div>
                        <div class="col-md-5">
                            <label class="form-label">URL</label>
                            <input type="text" name="quick_links[${index}][url]" class="form-control">
                        </div>
                        <div class="col-md-2 d-grid">
                            <button type="button" class="btn btn-outline-danger remove-row">Hapus</button>
                        </div>
                    </div>
                </div>
            </div>`,
        'program': (index) => `
            <div class="col-12 repeater-item" data-type="program">
                <div class="border rounded-3 p-3 bg-light-subtle">
                    <div class="row g-2 align-items-end">
                        <div class="col-md-4">
                            <label class="form-label">Label</label>
                            <input type="text" name="programs[${index}][label]" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">URL</label>
                            <input type="text" name="programs[${index}][url]" class="form-control">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Icon</label>
                            <input type="text" name="programs[${index}][icon]" class="form-control" value="fas fa-circle">
                        </div>
                        <div class="col-md-2 d-grid">
                            <button type="button" class="btn btn-outline-danger remove-row">Hapus</button>
                        </div>
                    </div>
                </div>
            </div>`,
        'social-link': (index) => `
            <div class="col-12 repeater-item" data-type="social-link">
                <div class="border rounded-3 p-3 bg-light-subtle">
                    <div class="row g-2 align-items-end">
                        <div class="col-md-3">
                            <label class="form-label">Platform</label>
                            <input type="text" name="social_links[${index}][platform]" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">URL</label>
                            <input type="text" name="social_links[${index}][url]" class="form-control">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Icon</label>
                            <input type="text" name="social_links[${index}][icon]" class="form-control" value="fab fa-linkedin-in">
                        </div>
                        <div class="col-md-2 d-grid">
                            <button type="button" class="btn btn-outline-danger remove-row">Hapus</button>
                        </div>
                    </div>
                </div>
            </div>`,
        'bottom-link': (index) => `
            <div class="col-12 repeater-item" data-type="bottom-link">
                <div class="border rounded-3 p-3 bg-light-subtle">
                    <div class="row g-2 align-items-end">
                        <div class="col-md-5">
                            <label class="form-label">Label</label>
                            <input type="text" name="bottom_links[${index}][label]" class="form-control">
                        </div>
                        <div class="col-md-5">
                            <label class="form-label">URL</label>
                            <input type="text" name="bottom_links[${index}][url]" class="form-control">
                        </div>
                        <div class="col-md-2 d-grid">
                            <button type="button" class="btn btn-outline-danger remove-row">Hapus</button>
                        </div>
                    </div>
                </div>
            </div>`,
    };

    document.addEventListener('click', function (event) {
        const addButton = event.target.closest('.add-row');
        if (addButton) {
            const type = addButton.dataset.type;
            const target = document.getElementById(addButton.dataset.target);

            if (type && target && templates[type]) {
                target.insertAdjacentHTML('beforeend', templates[type](counters[type]));
                counters[type] += 1;
            }
            return;
        }

        const removeButton = event.target.closest('.remove-row');
        if (removeButton) {
            const item = removeButton.closest('.repeater-item');
            if (item) {
                item.remove();
            }
        }
    });
});
</script>
@endpush