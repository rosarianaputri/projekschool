@extends('layouts.frontend')

@php
$title = 'Facilities - Layla School';
@endphp

@section('content')

<section class="container my-5 pt-5">

```
<h2 class="mb-4 text-center">Our Facilities</h2>
<p class="lead text-center">
    Layla School provides modern facilities to support both academic and extracurricular learning.
</p>

<div class="row mt-4 justify-content-center">

    <div class="col-md-4 mb-4">
        <div class="card shadow-sm h-100">
            <img src="{{ asset('images/perpustakaan.jpg') }}" class="card-img-top" alt="Library">
            <div class="card-body text-center">
                <h5>Library</h5>
                <p>Students can read, study, and explore knowledge in our comfortable school library.</p>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-4">
        <div class="card shadow-sm h-100">
            <img src="{{ asset('images/laboratorium2.jpg') }}" class="card-img-top" alt="Laboratory">
            <div class="card-body text-center">
                <h5>Laboratory</h5>
                <p>Our laboratory helps students learn science through experiments and practical activities.</p>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-4">
        <div class="card shadow-sm h-100">
            <img src="{{ asset('images/sporthall.jpg') }}" class="card-img-top" alt="Sports Hall">
            <div class="card-body text-center">
                <h5>Sports Hall</h5>
                <p>The sports hall supports various physical activities and helps students stay active and healthy.</p>
            </div>
        </div>
    </div>

</div>
```

</section>

@endsection
