@extends('admin.layouts.template')

@section('title', 'Tambah Mahasiswa - Schoularium')

@section('content')

    <main id="main" class="main">
        @if ($message = Session::get('success'))
            <div class="alert alert-success" role="alert">
                {{ $message }}
            </div>
        @endif

        @if ($message = Session::get('error'))
            <div class="alert alert-danger" role="alert">
                {{ $message }}
            </div>
        @endif

        <div class="pagetitle">
            <h1>Data Mahasiswa</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Daftar Mahasiswa</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card mb-3">

                        <div class="card-body">

                            <form class="row g-3 needs-validation" action="{{ route('admin.mahasiswa.store') }}" method="POST"
                                enctype="multipart/form-data" novalidate>
                                @csrf
                                <div class="col-12">
                                    <label for="nama" class="form-label">Nama</label>
                                    <input type="text" name="nama" class="form-control" id="nama" required>
                                    <div class="invalid-feedback">Masukkan Nama!</div>
                                </div>

                                <div class="col-12">
                                    <label for="nim" class="form-label">NIM</label>
                                    <input type="text" name="nim" class="form-control" id="nim">
                                    <div class="invalid-feedback">Masukkan nim!</div>
                                </div>
                                
                                <div class="col-12">
                                    <label for="angkatan" class="form-label">Angkatan</label>
                                    <input type="year" name="angkatan" class="form-control" id="angkatan">
                                    <div class="invalid-feedback">Masukkan angkatan!</div>
                                </div>

                                <div class="col-12">
                                    <button class="btn btn-primary w-100" type="submit">Tambahkan</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main><!-- End #main -->

@endsection
