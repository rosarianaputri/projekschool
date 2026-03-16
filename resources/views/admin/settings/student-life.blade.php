@extends('layouts.admin')

@php
    $title = 'LaylaSchool || Student Life Page';
    $pageTitle = 'Student Life Page';
    $extracurricular = $data['extracurricular'] ?? [];
    $extracurricularItems = $extracurricular['items'] ?? [];
    $achievements = $data['achievements'] ?? [];
    $achievementItems = $achievements['items'] ?? [];
    $gallery = $data['gallery'] ?? [];
@endphp

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    @if (session('status') === 'student_life_updated')
                        <div class="alert alert-success">Student Life page updated successfully.</div>
                    @elseif (session('status') === 'student_life_reset')
                        <div class="alert alert-warning">Student Life page has been reset.</div>
                    @elseif (session('status') === 'student_life_deleted')
                        <div class="alert alert-danger">Student Life page has been deleted.</div>
                    @endif

                    <form method="POST" action="{{ route('admin.student_life.update') }}" enctype="multipart/form-data">
                        @csrf

                        <!-- === EXTRACURRICULAR === -->
                        <h4 class="fw-bold mb-3" style="color:#4A47A3;">Extracurricular</h4>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Section Title</label>
                            <input type="text" name="extracurricular_title" class="form-control" 
                                   value="{{ old('extracurricular_title', $extracurricular['title'] ?? 'Extracurricular Activities') }}" required>
                        </div>

                        <div id="extracurricular_container">
                            @foreach($extracurricularItems as $index => $item)
                                <div class="extracurricular-item border rounded-3 bg-light p-3 mb-3 position-relative" data-index="{{ $index }}">
                                    <div class="position-absolute top-0 end-0 mt-2 me-2">
                                        <button type="button" class="btn btn-outline-danger btn-icon remove-extracurricular" title="Remove">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label class="form-label">Image</label>
                                            @if(!empty($item['image_url']))
                                                <img src="{{ $item['image_url'] }}" class="img-thumbnail mb-2" style="height:120px;">
                                            @endif
                                            <input type="hidden" name="extracurricular_items[{{ $index }}][existing_image]" value="{{ $item['image'] ?? '' }}">
                                            <input type="file" class="form-control" name="extracurricular_items[{{ $index }}][image]" accept="image/*">
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label">Title</label>
                                            <input type="text" class="form-control mb-2" name="extracurricular_items[{{ $index }}][title]" 
                                                   value="{{ $item['title'] ?? '' }}" required>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label">Description</label>
                                            <textarea class="form-control" rows="3" name="extracurricular_items[{{ $index }}][text]" required>{{ $item['text'] ?? '' }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <button type="button" id="add_extracurricular" class="btn btn-outline-primary btn-sm mt-2">+ Add Extracurricular</button>

                        <hr class="my-4">

                        <!-- === ACHIEVEMENTS === -->
                        <h4 class="fw-bold mb-3" style="color:#4A47A3;">Achievements & Awards</h4>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Section Title</label>
                            <input type="text" name="achievements_title" class="form-control" 
                                   value="{{ old('achievements_title', $achievements['title'] ?? 'Student Achievements') }}" required>
                        </div>

                        <div id="achievements_container">
                            @foreach($achievementItems as $index => $item)
                                <div class="achievement-item border rounded-3 bg-light p-3 mb-3 position-relative" data-index="{{ $index }}">
                                    <div class="position-absolute top-0 end-0 mt-2 me-2">
                                        <button type="button" class="btn btn-outline-danger btn-icon remove-achievement" title="Remove">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label class="form-label">Image</label>
                                            @if(!empty($item['image_url']))
                                                <img src="{{ $item['image_url'] }}" class="img-thumbnail mb-2" style="height:120px;">
                                            @endif
                                            <input type="hidden" name="achievements_items[{{ $index }}][existing_image]" value="{{ $item['image'] ?? '' }}">
                                            <input type="file" class="form-control" name="achievements_items[{{ $index }}][image]" accept="image/*">
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label">Title</label>
                                            <input type="text" class="form-control mb-2" name="achievements_items[{{ $index }}][title]" 
                                                value="{{ $item['title'] ?? '' }}" required>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label">Description</label>
                                            <textarea class="form-control" rows="3" name="achievements_items[{{ $index }}][text]" required>{{ $item['text'] ?? '' }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <button type="button" id="add_achievement" class="btn btn-outline-primary btn-sm mt-2">+ Add Achievement</button>

                        <hr class="my-4">

                        <!-- === GALLERY === -->
                        <h4 class="fw-bold mb-3" style="color:#4A47A3;">Gallery</h4>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Section Title</label>
                            <input type="text" name="gallery_title" class="form-control" 
                                value="{{ old('gallery_title', $gallery['title'] ?? 'Student Life Gallery') }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Description</label>
                            <textarea name="gallery_text" rows="3" class="form-control" required>{{ old('gallery_text', $gallery['text'] ?? '') }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Image</label>
                            @if(!empty($gallery['image_url']))
                                <img src="{{ $gallery['image_url'] }}" alt="Gallery" class="img-thumbnail mb-2" style="height:200px;">
                            @endif
                            <input type="hidden" name="existing_gallery_image" value="{{ $gallery['image'] ?? '' }}">
                            <input type="file" name="gallery_image" class="form-control" accept="image/*">
                        </div>

                        <div class="d-flex justify-content-end gap-2 mt-4">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save</button>
                            <form method="POST" action="{{ route('admin.student_life.reset') }}" class="d-inline">@csrf
                                <button type="submit" class="btn btn-warning"><i class="fas fa-undo"></i> Reset</button>
                            </form>
                            <form method="POST" action="{{ route('admin.student_life.destroy') }}" class="d-inline">@csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> Delete</button>
                            </form>
                            <a href="{{ route('front.student_life') }}" target="_blank" class="btn btn-secondary">
                                <i class="fas fa-external-link-alt"></i> Preview
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.btn-icon {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
}
.btn-icon i { font-size: 15px; }
.btn-outline-danger.btn-icon {
    border-color: #ff4b5c;
    color: #ff4b5c;
}
.btn-outline-danger.btn-icon:hover {
    background-color: #ff4b5c;
    color: #fff;
    border-color: transparent;
}
.fadeIn { animation: fadeIn .4s ease-in-out; }
@keyframes fadeIn { from {opacity:0; transform:translateY(10px);} to {opacity:1; transform:translateY(0);} }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    let exIndex = {{ count($extracurricularItems) }};
    let achIndex = {{ count($achievementItems) }};

    document.addEventListener('click', e => {
        const btn = e.target.closest('button');
        if (!btn) return;

        // === Add Extracurricular ===
        if (btn.id === 'add_extracurricular') {
            const c = document.getElementById('extracurricular_container');
            const el = document.createElement('div');
            el.className = 'extracurricular-item border rounded-3 bg-light p-3 mb-3 position-relative fadeIn';
            el.innerHTML = `
                <div class="position-absolute top-0 end-0 mt-2 me-2">
                    <button type="button" class="btn btn-outline-danger btn-icon remove-extracurricular" title="Remove"><i class="fas fa-trash"></i></button>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <label class="form-label">Image</label>
                        <input type="hidden" name="extracurricular_items[${exIndex}][existing_image]" value="">
                        <input type="file" class="form-control" name="extracurricular_items[${exIndex}][image]" accept="image/*">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Title</label>
                        <input type="text" class="form-control mb-2" name="extracurricular_items[${exIndex}][title]" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" rows="3" name="extracurricular_items[${exIndex}][text]" required></textarea>
                    </div>
                </div>`;
            c.appendChild(el);
            exIndex++;
        }

        // === Add Achievement ===
        if (btn.id === 'add_achievement') {
            const c = document.getElementById('achievements_container');
            const el = document.createElement('div');
            el.className = 'achievement-item border rounded-3 bg-light p-3 mb-3 position-relative fadeIn';
            el.innerHTML = `
                <div class="position-absolute top-0 end-0 mt-2 me-2">
                    <button type="button" class="btn btn-outline-danger btn-icon remove-achievement" title="Remove"><i class="fas fa-trash"></i></button>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <label class="form-label">Image</label>
                        <input type="hidden" name="achievements_items[${achIndex}][existing_image]" value="">
                        <input type="file" class="form-control" name="achievements_items[${achIndex}][image]" accept="image/*">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Title</label>
                        <input type="text" class="form-control mb-2" name="achievements_items[${achIndex}][title]" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" rows="3" name="achievements_items[${achIndex}][text]" required></textarea>
                    </div>
                </div>`;
            c.appendChild(el);
            achIndex++;
        }

        // === Remove Item ===
        if (btn.classList.contains('remove-extracurricular')) btn.closest('.extracurricular-item').remove();
        if (btn.classList.contains('remove-achievement')) btn.closest('.achievement-item').remove();
    });
});
</script>
@endpush
