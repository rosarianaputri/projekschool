@extends('layouts.admin')

@php
    $title = 'LaylaSchool || Kelola Fasilitas';
    $pageTitle = 'Kelola Fasilitas';
    $sections = $data['sections'] ?? [];
@endphp

@section('content')
<div class="row">
    <div class="col-12">

        {{-- Alert Status --}}
        @if (session('status') === 'facilities_updated')
            <div class="alert alert-success alert-dismissible fade show">
                <i class="feather-check-circle me-2"></i> Data fasilitas berhasil disimpan!
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @elseif (session('status') === 'facilities_reset')
            <div class="alert alert-warning alert-dismissible fade show">
                <i class="feather-alert-triangle me-2"></i> Data fasilitas berhasil direset.
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @elseif (session('status') === 'facilities_deleted')
            <div class="alert alert-danger alert-dismissible fade show">
                <i class="feather-trash-2 me-2"></i> Data fasilitas berhasil dihapus.
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        {{-- Header --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h5 class="fw-semibold mb-1">
                    <i class="feather-grid me-2 text-primary"></i>Daftar Fasilitas Sekolah
                </h5>
                <p class="text-muted small mb-0">
                    Kelola fasilitas yang ditampilkan di halaman website. ({{ count($sections) }} fasilitas tersimpan)
                </p>
            </div>
            <a href="{{ route('front.facilities') }}" target="_blank" class="btn btn-outline-secondary btn-sm">
                <i class="feather-external-link me-1"></i> Preview Website
            </a>
        </div>

        {{-- Main Form --}}
        <form method="POST" action="{{ route('admin.facilities.update') }}" enctype="multipart/form-data" id="facilities-form">
            @csrf

            <div id="sections-wrapper">
                @forelse($sections as $i => $section)
                    @php
                        $imgUrl = !empty($section['image_url'])
                            ? $section['image_url']
                            : (!empty($section['image']) ? Storage::url($section['image']) : null);
                    @endphp
                    <div class="card mb-3 section-item shadow-sm border-0">
                        <div class="card-header d-flex justify-content-between align-items-center py-2" style="background:#f8f9fa;">
                            <span class="fw-semibold">
                                <i class="feather-grid me-2 text-primary"></i>
                                Fasilitas #{{ $i + 1 }}
                                @if(!empty($section['title']))
                                    &mdash; <span class="text-muted fw-normal">{{ $section['title'] }}</span>
                                @endif
                            </span>
                            <button type="button" class="btn btn-outline-danger btn-sm remove-section">
                                <i class="feather-trash-2 me-1"></i> Hapus
                            </button>
                        </div>
                        <div class="card-body">
                            <input type="hidden" name="sections[{{ $i }}][existing_image]" value="{{ $section['image'] ?? '' }}">
                            <div class="row">
                                {{-- Image --}}
                                <div class="col-md-3 mb-3">
                                    <label class="form-label fw-medium small text-uppercase text-muted">Gambar</label>
                                    <div class="mb-2">
                                        @if($imgUrl)
                                            <img src="{{ $imgUrl }}"
                                                 class="img-thumbnail section-preview"
                                                 style="height:130px; width:100%; object-fit:cover;"
                                                 id="preview-img-{{ $i }}">
                                        @else
                                            <div class="bg-light border rounded d-flex align-items-center justify-content-center section-preview-placeholder"
                                                 style="height:130px;" id="preview-img-{{ $i }}">
                                                <i class="feather-image text-muted" style="font-size:2rem;"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <input type="file"
                                           name="sections[{{ $i }}][image]"
                                           class="form-control form-control-sm section-image-input"
                                           accept="image/png,image/jpeg,image/jpg,image/webp"
                                           data-index="{{ $i }}">
                                    <small class="text-muted d-block mt-1">Biarkan kosong untuk tetap pakai gambar lama.</small>
                                </div>

                                {{-- Title --}}
                                <div class="col-md-4 mb-3">
                                    <label class="form-label fw-medium small text-uppercase text-muted">Nama Fasilitas</label>
                                    <input type="text"
                                           name="sections[{{ $i }}][title]"
                                           class="form-control"
                                           value="{{ old('sections.'.$i.'.title', $section['title'] ?? '') }}"
                                           placeholder="Contoh: Perpustakaan"
                                           required>
                                </div>

                                {{-- Description --}}
                                <div class="col-md-5 mb-3">
                                    <label class="form-label fw-medium small text-uppercase text-muted">Deskripsi</label>
                                    <textarea name="sections[{{ $i }}][text]"
                                              rows="4"
                                              class="form-control"
                                              placeholder="Deskripsi singkat fasilitas..."
                                              required>{{ old('sections.'.$i.'.text', $section['text'] ?? '') }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="alert alert-info" id="empty-notice">
                        <i class="feather-info me-2"></i> Belum ada data fasilitas. Klik <strong>"+ Tambah Fasilitas"</strong> untuk menambah.
                    </div>
                @endforelse
            </div>

            {{-- Add Section Button --}}
            <div class="mb-4">
                <button type="button" class="btn btn-outline-primary" id="add-section">
                    <i class="feather-plus-circle me-1"></i> Tambah Fasilitas
                </button>
            </div>

            {{-- Action Buttons --}}
            <div class="card border-0 shadow-sm">
                <div class="card-body d-flex flex-wrap gap-2 align-items-center">
                    <button type="submit" class="btn btn-primary">
                        <i class="feather-save me-1"></i> Simpan Perubahan
                    </button>
                    <a href="{{ route('front.facilities') }}" target="_blank" class="btn btn-outline-secondary">
                        <i class="feather-external-link me-1"></i> Preview
                    </a>
                    <div class="vr mx-1 d-none d-md-block"></div>
                    <form method="POST" action="{{ route('admin.facilities.reset') }}" class="d-inline m-0">
                        @csrf
                        <button type="submit" class="btn btn-warning"
                                onclick="return confirm('Reset semua data fasilitas ke kosong?')">
                            <i class="feather-refresh-cw me-1"></i> Reset
                        </button>
                    </form>
                    <form method="POST" action="{{ route('admin.facilities.destroy') }}" class="d-inline m-0"
                          onsubmit="return confirm('Hapus permanen semua data fasilitas?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger">
                            <i class="feather-trash-2 me-1"></i> Hapus Semua
                        </button>
                    </form>
                </div>
            </div>

        </form>
    </div>
</div>

{{-- Hidden template for new section --}}
<template id="section-template">
    <div class="card mb-3 section-item shadow-sm border-0">
        <div class="card-header d-flex justify-content-between align-items-center py-2" style="background:#f8f9fa;">
            <span class="fw-semibold">
                <i class="feather-grid me-2 text-primary"></i>
                Fasilitas #<span class="section-num"></span>
            </span>
            <button type="button" class="btn btn-outline-danger btn-sm remove-section">
                <i class="feather-trash-2 me-1"></i> Hapus
            </button>
        </div>
        <div class="card-body">
            <input type="hidden" name="sections[__IDX__][existing_image]" value="">
            <div class="row">
                <div class="col-md-3 mb-3">
                    <label class="form-label fw-medium small text-uppercase text-muted">Gambar</label>
                    <div class="bg-light border rounded d-flex align-items-center justify-content-center mb-2 section-preview-placeholder"
                         style="height:130px;" id="preview-img-__IDX__">
                        <i class="feather-image text-muted" style="font-size:2rem;"></i>
                    </div>
                    <input type="file"
                           name="sections[__IDX__][image]"
                           class="form-control form-control-sm section-image-input"
                           accept="image/png,image/jpeg,image/jpg,image/webp"
                           data-index="__IDX__">
                    <small class="text-muted d-block mt-1">Pilih gambar fasilitas.</small>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label fw-medium small text-uppercase text-muted">Nama Fasilitas</label>
                    <input type="text"
                           name="sections[__IDX__][title]"
                           class="form-control"
                           placeholder="Contoh: Lapangan Olahraga"
                           required>
                </div>
                <div class="col-md-5 mb-3">
                    <label class="form-label fw-medium small text-uppercase text-muted">Deskripsi</label>
                    <textarea name="sections[__IDX__][text]"
                              rows="4"
                              class="form-control"
                              placeholder="Deskripsi singkat fasilitas..."
                              required></textarea>
                </div>
            </div>
        </div>
    </div>
</template>

@push('scripts')
<script>
    let sectionIndex = {{ count($sections) }};

    // Add new section
    document.getElementById('add-section').addEventListener('click', function () {
        const wrapper   = document.getElementById('sections-wrapper');
        const template  = document.getElementById('section-template');
        const fragment  = template.content.cloneNode(true);
        const card      = fragment.querySelector('.section-item');

        card.innerHTML = card.innerHTML.replaceAll('__IDX__', sectionIndex);
        card.querySelector('.section-num').textContent = sectionIndex + 1;

        // Remove empty notice if present
        const notice = document.getElementById('empty-notice');
        if (notice) notice.remove();

        wrapper.appendChild(card);
        sectionIndex++;
    });

    // Remove section
    document.addEventListener('click', function (e) {
        const btn = e.target.closest('.remove-section');
        if (btn) {
            btn.closest('.section-item').remove();
        }
    });

    // Live image preview
    document.addEventListener('change', function (e) {
        if (!e.target.classList.contains('section-image-input')) return;
        const file = e.target.files[0];
        if (!file) return;

        const idx    = e.target.dataset.index;
        const prevEl = document.getElementById('preview-img-' + idx);
        if (!prevEl) return;

        const reader = new FileReader();
        reader.onload = function (ev) {
            const img = document.createElement('img');
            img.src   = ev.target.result;
            img.id    = 'preview-img-' + idx;
            img.className = 'img-thumbnail section-preview';
            img.style.cssText = 'height:130px; width:100%; object-fit:cover;';
            prevEl.replaceWith(img);
        };
        reader.readAsDataURL(file);
    });
</script>
@endpush
@endsection
