@extends('layouts.admin')

@php
$title = 'Data Siswa';
$pageTitle = 'Data Siswa';
@endphp

@section('content')

<div class="container-fluid">

<div class="card shadow-sm">

<div class="card-header">
<h5 class="mb-0">Data Siswa</h5>
</div>

<div class="card-body">

<div class="table-responsive">

<table class="table table-striped table-hover align-middle">

<thead>
<tr>
<th>No</th>
<th>Nama Siswa</th>
<th>Asal Sekolah</th>
<th>Nama Orang Tua</th>
<th>No HP</th>
<th>Status</th>
</tr>
</thead>

<tbody>

@foreach ($students as $student)

<tr>
<td>{{ $loop->iteration }}</td>
<td>{{ $student->student_name }}</td>
<td>{{ $student->previous_school }}</td>
<td>{{ $student->parent_name }}</td>
<td>{{ $student->phone }}</td>
<td>{{ $student->status }}</td>
</tr>

@endforeach

</tbody>

</table>

</div>

</div>

</div>

</div>

@endsection
