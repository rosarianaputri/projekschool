@extends('layouts.student')

@section('content')

<h4 class="mb-4">
    Selamat datang, {{ auth()->user()->name }}
</h4>

<div class="row">

    <!-- FORMULIR PENDAFTARAN -->
    <div class="col-md-4">
        <a href="{{ route('student.ppdb.form') }}" style="text-decoration:none;">
            <div class="card">
                <div class="card-body text-center">

                    <h5>
                        <i class="fa fa-file"></i> Formulir Pendaftaran
                    </h5>

                    <p>Isi formulir pendaftaran siswa baru.</p>

                </div>
            </div>
        </a>
    </div>

    <!-- UPLOAD BERKAS -->
    <div class="col-md-4">
        <a href="{{ route('student.ppdb.form') }}" style="text-decoration:none;">
            <div class="card">
                <div class="card-body text-center">

                    <h5>
                        <i class="fa fa-upload"></i> Upload Berkas
                    </h5>

                    <p>Upload dokumen persyaratan.</p>

                </div>
            </div>
        </a>
    </div>

    <!-- STATUS PENDAFTARAN -->
    <div class="col-md-4">
        <a href="{{ route('student.ppdb.index') }}" style="text-decoration:none;">
            <div class="card">
                <div class="card-body text-center">

                    <h5>
                        <i class="fa fa-clock"></i> Status Pendaftaran
                    </h5>

                    <p>Cek status hasil seleksi.</p>

                </div>
            </div>
        </a>
    </div>

</div>

@endsection