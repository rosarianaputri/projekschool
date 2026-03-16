@extends('layouts.frontend')

@php
$title = 'Student Life - Layla School';
$data = is_array($studentLifeData ?? null) ? $studentLifeData : [];

$extracurricularSection = $data['extracurricular'] ?? [];
$achievementsSection = $data['achievements'] ?? [];
$gallery = $data['gallery'] ?? [];

$extracurricular = is_array($extracurricularSection['items'] ?? null) ? $extracurricularSection['items'] : [];
$achievements = is_array($achievementsSection['items'] ?? null) ? $achievementsSection['items'] : [];

$fallbackExtracurricular = [
    [
        'title' => 'Sports and Teamwork',
        'text' => 'Students develop discipline, fitness, and collaboration through regular sports programs.',
        'image_url' => asset('images/ekstrakulikuler/futsal.jpg'),
    ],
    [
        'title' => 'Scouting Program',
        'text' => 'Character, leadership, and resilience are built through outdoor scouting activities.',
        'image_url' => asset('images/ekstrakulikuler/pramuka.jpg'),
    ],
    [
        'title' => 'Creative Arts',
        'text' => 'Art and performance clubs encourage confidence and creativity in every student.',
        'image_url' => asset('images/ekstrakulikuler/seni.jpg'),
    ],
];

$fallbackAchievements = [
    [
        'title' => 'Science Competition Winner',
        'text' => 'Our students consistently earn top recognition in regional science events.',
        'image_url' => asset('images/award/sainjuara.png'),
    ],
    [
        'title' => 'Basketball Championship',
        'text' => 'The school team proudly brought home the championship title this year.',
        'image_url' => asset('images/award/basketjuara.jpg'),
    ],
    [
        'title' => 'Art Excellence Award',
        'text' => 'Students received awards for outstanding creativity in painting and design.',
        'image_url' => asset('images/award/lukis.jpg'),
    ],
];

if (empty($extracurricular)) {
    $extracurricular = $fallbackExtracurricular;
}

if (empty($achievements)) {
    $achievements = $fallbackAchievements;
}

if (empty($gallery['title'])) {
    $gallery['title'] = 'Student Life Gallery';
}

if (empty($gallery['text'])) {
    $gallery['text'] = 'A quick look into vibrant moments from classes, projects, and student events.';
}

if (empty($gallery['image_url'])) {
    $gallery['image_url'] = asset('images/galeri/kelulusan1.png');
}
@endphp

@section('content')

<section class="py-5 text-center bg-light border-bottom">
    <div class="container">
        <h1 class="fw-bold mb-3">Student Life</h1>
        <p class="text-muted mb-0">Explore activities, achievements, and meaningful moments from our student community.</p>
    </div>
</section>

<div class="container my-5">

<h2 class="text-center mb-4 fw-bold">{{ $extracurricularSection['title'] ?? 'Extracurricular Activities' }}</h2>

<div class="row g-4 justify-content-center">

@forelse($extracurricular as $item)

<div class="col-lg-4 col-md-6">
<div class="card h-100 shadow-sm">
@if(!empty($item['image_url']))
<img src="{{ $item['image_url'] }}" class="card-img-top" style="height:220px; object-fit:cover;" alt="{{ $item['title'] ?? 'Student activity' }}">
@endif

<div class="card-body text-center">
<h5 class="fw-semibold">{{ $item['title'] ?? 'Student Activity' }}</h5>
<p class="text-muted mb-0">{{ $item['text'] ?? 'Students actively participate in programs that build both skills and character.' }}</p>
</div>

</div>
</div>

@empty

<p class="text-center text-muted">No extracurricular activities available yet.</p>
@endforelse

</div>

<section class="mt-5">

<h2 class="text-center mb-4 fw-bold">{{ $achievementsSection['title'] ?? 'Student Achievements' }}</h2>

<div class="row g-4 justify-content-center">

@forelse($achievements as $item)

<div class="col-lg-4 col-md-6">
<div class="card h-100 shadow-sm">
@if(!empty($item['image_url']))
<img src="{{ $item['image_url'] }}" class="card-img-top" style="height:220px; object-fit:cover;" alt="{{ $item['title'] ?? 'Student achievement' }}">
@endif

<div class="card-body">
<h5 class="fw-semibold">{{ $item['title'] ?? 'Student Achievement' }}</h5>
<p class="text-muted mb-0">{{ $item['text'] ?? 'Our students continue to demonstrate excellent results in academic and non-academic competitions.' }}</p>
</div>

</div>
</div>

@empty

<p class="text-center text-muted">No achievements available yet.</p>
@endforelse

</div>

</section>

<section class="mt-5">

<h2 class="text-center mb-4 fw-bold">{{ $gallery['title'] }}</h2>
<p class="text-center text-muted mb-4">{{ $gallery['text'] ?? '' }}</p>

@if(!empty($gallery['image_url']))

<div class="card border-0 shadow-sm">
<img src="{{ $gallery['image_url'] }}" class="img-fluid rounded" style="height:420px; object-fit:cover;" alt="Student life gallery image">
</div>
@endif

</section>

</div>

@endsection
