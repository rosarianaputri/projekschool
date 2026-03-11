@extends('layouts.student')

@section('content')

<h4 class="mb-4">
Selamat datang, {{ auth()->user()->name }}
</h4>

<div class="row">

<div class="col-md-4">
<div class="card">
<div class="card-body">

<h5>
<i class="fa fa-list"></i> Tahapan PPDB
</h5>

<p>Lihat tahapan pendaftaran siswa.</p>

</div>
</div>
</div>


<div class="col-md-4">
<div class="card">
<div class="card-body">

<h5>
<i class="fa fa-upload"></i> Upload Berkas
</h5>

<p>Upload dokumen pendaftaran.</p>

</div>
</div>
</div>


<div class="col-md-4">
<div class="card">
<div class="card-body">

<h5>
<i class="fa fa-clock"></i> Status
</h5>

<p>Cek status pendaftaran.</p>

</div>
</div>
</div>

</div>

@endsection