@extends('layouts.admin')

@php
$title = 'Tambah Guru';
$pageTitle = 'Tambah Guru';
@endphp

@section('content')

<div class="container-fluid">

```
<div class="card shadow-sm">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Tambah Data Guru</h5>
        <a href="{{ route('teachers.index') }}" class="btn btn-secondary btn-sm">
            Kembali
        </a>
    </div>

    <div class="card-body">

        <form action="{{ route('teachers.store') }}" method="POST">
            @csrf

            <div class="row">

                <div class="col-md-6 mb-3">
                    <label class="form-label">Nama Guru</label>
                    <input type="text" name="name" class="form-control" placeholder="Masukkan nama guru" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">NIP</label>
                    <input type="text" name="nip" class="form-control" placeholder="Masukkan NIP">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Jabatan</label>
                    <input type="text" name="position" class="form-control" placeholder="Contoh: Guru Matematika">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">No HP</label>
                    <input type="text" name="phone" class="form-control" placeholder="08xxxxxxxx">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" placeholder="email@gmail.com">
                </div>

            </div>

            <div class="mt-3">
                <button type="submit" class="btn btn-primary">
                    Simpan
                </button>

                <a href="{{ route('teachers.index') }}" class="btn btn-light">
                    Batal
                </a>
            </div>

        </form>

    </div>
</div>
```

</div>

@endsection
