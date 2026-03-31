@extends(auth()->check() && in_array(strtolower((string) auth()->user()->role), ['student', 'siswa'], true) ? 'layouts.student' : 'layouts.admin')

@php
    $title = 'LaylaSchool || Profile';
    $pageTitle = 'Profile';
@endphp

@section('content')
    @php
        $isStudentProfile = auth()->check() && in_array(strtolower((string) auth()->user()->role), ['student', 'siswa'], true);
    @endphp

    @if ($isStudentProfile)
        <div class="nxl-content-right">
            <div class="nxl-content-inner" style="padding-top: 60px; padding-left: 40px; padding-right: 40px; padding-bottom: 40px;">
    @endif

    <div class="row">
        <div class="col-lg-8 col-md-10">
            <div class="card mb-4">
                <div class="card-body">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-body">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-body">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>

    @if ($isStudentProfile)
            </div>
        </div>
    @endif
@endsection
