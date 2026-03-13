@extends('layouts.frontend')

@php
    $title = 'About Us - Layla School';
@endphp

@section('content')
    @if(isset($aboutData) && $aboutData)
        <section id="principal" class="container my-5 pt-5">
            <h2>{{ $aboutData['principal']['title'] ?? "Principal’s Message" }}</h2>
            <img src="{{ $aboutData['principal']['image_url'] ?? asset('images/kepalasekolah.png') }}" alt="Principal">
            <p class="lead mt-3">{{ $aboutData['principal']['text'] ?? '' }}</p>
        </section>

        <section id="vision-mission" class="container my-5">
            <h2>Vision & Mission</h2>

            <div class="row mt-4">
                <div class="col-md-6 mb-4">
                    <h3>{{ $aboutData['vision_mission']['vision_title'] ?? 'Our Vision' }}</h3>
                    <p>{{ $aboutData['vision_mission']['vision_text'] ?? '' }}</p>
                </div>

                <div class="col-md-6">
                    <h3>{{ $aboutData['vision_mission']['mission_title'] ?? 'Our Mission' }}</h3>
                    <ul>
                        @foreach(($aboutData['vision_mission']['mission_items'] ?? []) as $item)
                            <li>{{ $item }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </section>

        <section id="history" class="container my-5">
            <h2>{{ $aboutData['history']['title'] ?? 'Our History' }}</h2>
            <img src="{{ $aboutData['history']['image_url'] ?? asset('images/history.png') }}" alt="School Building" class="img-fluid mb-3">
            <p>{{ $aboutData['history']['text'] ?? '' }}</p>
        </section>

        <section id="org-structure" class="section-container text-center">
            <h2>{{ $aboutData['org']['title'] ?? 'Organizational Structure' }}</h2>
            <p>{{ $aboutData['org']['text'] ?? '' }}</p>

            <div class="row mt-4">
                @foreach(($aboutData['org']['members'] ?? []) as $member)
                    <div class="col-md-3 mb-4">
                        <div class="card p-3 shadow-sm">
                            <img src="{{ $member['image_url'] ?? asset('images/kepalasekolah.png') }}" class="card-img-top rounded-circle mx-auto mt-2" style="width:120px; height:120px; object-fit:cover;">
                            <div class="card-body">
                                <h5 class="card-title mb-0">{{ $member['name'] ?? '' }}</h5>
                                <p class="text-muted">{{ $member['role'] ?? '' }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    @elseif(isset($page) && $page && $pageContent)
        {!! $pageContent !!}
    @else
    <section id="principal" class="container my-5 pt-5">
        <h2>Principal’s Message</h2>
        <img src="{{ asset('images/kepalasekolah.png') }}" alt="Principal">
        <p class="lead mt-3">Welcome to Layla School, where education is not only about learning but also about character, creativity, and compassion. We believe that every child has great potential — our mission is to guide them toward becoming the best version of themselves, ready to face the future with confidence and kindness.</p>
    </section>

    <section id="vision-mission" class="container my-5">
        <h2>Vision & Mission</h2>

        <div class="row mt-4">
            <div class="col-md-6 mb-4">
                <h3>Our Vision</h3>
                <p>To become a leading educational institution that nurtures intelligent, creative, and moral students who contribute positively to society and the world.</p>
            </div>

            <div class="col-md-6">
                <h3>Our Mission</h3>
                <ul>
                    <li>Provide a holistic and engaging learning environment.</li>
                    <li>Develop students’ intellectual and emotional intelligence.</li>
                    <li>Encourage creativity, discipline, and responsibility.</li>
                    <li>Promote respect, diversity, and environmental awareness.</li>
                </ul>
            </div>
        </div>
    </section>

    <section id="history" class="container my-5">
        <h2>Our History</h2>
        <img src="{{ asset('images/history.png') }}" alt="School Building" class="img-fluid mb-3">
        <p>Founded in 2005, Layla School has grown from a small community-based institution into a reputable educational center known for its commitment to excellence. Over the years, our school has produced outstanding graduates who continue to make a difference in various fields both nationally and internationally.</p>
    </section>

    <section id="org-structure" class="section-container text-center">
        <h2>Organizational Structure</h2>
        <p>Meet the leadership team of Layla School.</p>

        <div class="row mt-4">
            <div class="col-md-3 mb-4">
                <div class="card p-3 shadow-sm">
                    <img src="{{ asset('images/kepalasekolah.png') }}" class="card-img-top rounded-circle mx-auto mt-2" style="width:120px; height:120px; object-fit:cover;">
                    <div class="card-body">
                        <h5 class="card-title mb-0">Mrs. Layla Rahma</h5>
                        <p class="text-muted">Principal</p>
                    </div>
                </div>
            </div>

            <div class="col-md-3 mb-4">
                <div class="card p-3 shadow-sm">
                    <img src="{{ asset('images/dimas.png') }}" class="card-img-top rounded-circle mx-auto mt-2" style="width:120px; height:120px; object-fit:cover;">
                    <div class="card-body">
                        <h5 class="card-title mb-0">Mr. Dimas Arif</h5>
                        <p class="text-muted">Vice Principal - Curriculum</p>
                    </div>
                </div>
            </div>

            <div class="col-md-3 mb-4">
                <div class="card p-3 shadow-sm">
                    <img src="{{ asset('images/siti.jpeg') }}" class="card-img-top rounded-circle mx-auto mt-2" style="width:120px; height:120px; object-fit:cover;">
                    <div class="card-body">
                        <h5 class="card-title mb-0">Mrs. Siti Nabila</h5>
                        <p class="text-muted">Vice Principal - Student Affairs</p>
                    </div>
                </div>
            </div>

            <div class="col-md-3 mb-4">
                <div class="card p-3 shadow-sm">
                    <img src="{{ asset('images/arif.jpeg') }}" class="card-img-top rounded-circle mx-auto mt-2" style="width:120px; height:120px; object-fit:cover;">
                    <div class="card-body">
                        <h5 class="card-title mb-0">Mr. Arfan Yusuf</h5>
                        <p class="text-muted">Administrative Staff</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif
@endsection
