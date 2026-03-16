@extends('layouts.frontend')

@php
$title = 'Student Life - Layla School';

$studentLife = \DB::table('student_life')
->where('section','student_life_page')
->first();

$data = $studentLife ? json_decode($studentLife->data, true) : [];

$extracurricular = $data['extracurricular']['items'] ?? [];
$achievements = $data['achievements']['items'] ?? [];
$gallery = $data['gallery'] ?? [];
@endphp

@section('content')

<section class="py-5 text-center">
    <h1 class="fw-bold">Student Life</h1>
    <p class="text-muted">Explore activities, achievements, and memorable moments at Layla School</p>
</section>

<div class="container my-5">

{{-- ================= EXTRACURRICULAR ================= --}}

<h2 class="text-center mb-4 fw-bold">Extracurricular</h2>

<div class="row g-4 justify-content-center">

@forelse($extracurricular as $item)

<div class="col-lg-4 col-md-6">
<div class="card h-100 shadow-sm">

@if(!empty($item['image_url'])) <img src="{{ asset($item['image_url']) }}" 
class="card-img-top" 
style="height:200px; object-fit:cover;">
@endif

<div class="card-body text-center">
<h5 class="fw-semibold">{{ $item['title'] ?? '' }}</h5>
<p class="text-muted">{{ $item['text'] ?? '' }}</p>
</div>

</div>
</div>

@empty

<p class="text-center text-muted">No extracurricular activities yet.</p>
@endforelse

</div>

{{-- ================= ACHIEVEMENTS ================= --}}

<section class="mt-5">

<h2 class="text-center mb-4 fw-bold">Achievements & Awards</h2>

<div class="row g-4 text-center">

@forelse($achievements as $item)

<div class="col-md-4">
<div class="card h-100 shadow-sm">

@if(!empty($item['image_url'])) <img src="{{ asset($item['image_url']) }}" 
class="card-img-top" 
style="height:200px; object-fit:cover;">
@endif

<div class="card-body">
<h5 class="fw-semibold">{{ $item['title'] ?? '' }}</h5>
<p class="text-muted">{{ $item['text'] ?? '' }}</p>
</div>

</div>
</div>

@empty

<p class="text-center text-muted">No achievements yet.</p>
@endforelse

</div>

</section>

{{-- ================= GALLERY ================= --}}

<section class="mt-5">

<h2 class="text-center mb-4 fw-bold">{{ $gallery['title'] ?? 'Gallery' }}</h2>
<p class="text-center text-muted mb-4">{{ $gallery['text'] ?? '' }}</p>

@if(!empty($gallery['image_url']))

<div class="card border-0 shadow-sm">
<img src="{{ asset($gallery['image_url']) }}" 
class="img-fluid rounded"
style="height:400px; object-fit:cover;">
</div>
@endif

</section>

</div>

@endsection
