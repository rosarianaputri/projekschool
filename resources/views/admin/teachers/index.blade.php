@extends('layouts.admin')

@php
$title = 'Data Guru';
$pageTitle = 'Data Guru';
@endphp

@section('content')

<div class="card">
    <div class="card-body">

```
    <div class="d-flex justify-content-between mb-3">
        <h5 class="mb-0">Daftar Guru</h5>
        <a href="{{ route('teachers.create') }}" class="btn btn-primary btn-sm">
            + Tambah Guru
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered align-middle">

        <thead>
            <tr>
                <th>Nama</th>
                <th>NIP</th>
                <th>Jabatan</th>
                <th>No HP</th>
                <th>Email</th>
                <th>Akun</th>
            </tr>
        </thead>

        <tbody>

            @forelse ($teachers as $teacher)

                <tr>
                    <td>{{ $teacher->name }}</td>
                    <td>{{ $teacher->nip }}</td>
                    <td>{{ $teacher->position }}</td>
                    <td>{{ $teacher->phone }}</td>
                    <td>{{ $teacher->email }}</td>
                    <td>{{ optional($teacher->user)->name ?? '-' }}</td>
                </tr>

            @empty

                <tr>
                    <td colspan="5" class="text-center text-muted">
                        Belum ada data guru.
                    </td>
                </tr>

            @endforelse

        </tbody>

    </table>

    {{ $teachers->links() }}

</div>


</div>

@endsection
