@extends('layouts.admin')

@php
    $title = 'LaylaSchool || Profile';
    $pageTitle = 'Profile';
@endphp

@section('content')
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
@endsection
