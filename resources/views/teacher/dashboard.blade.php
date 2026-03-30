@extends('layouts.admin')

@php
    $title = 'LaylaSchool || Dashboard Guru';
    $pageTitle = 'Dashboard Guru';
@endphp

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body py-5">
                <h4 class="mb-2">Selamat datang, Guru</h4>
                <p class="mb-0 text-muted">Anda berhasil login dan masuk ke dashboard sesuai role guru.</p>
            </div>
        </div>
    </div>
</div>
@endsection
