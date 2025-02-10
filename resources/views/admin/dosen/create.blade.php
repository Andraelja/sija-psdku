@extends('admin.layouts.template')

@section('title', 'Tambah Dosen - Schoularium')

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
            <h1>Data Dosen</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Daftar Dosen</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card mb-3">

                        <div class="card-body">

                            <form class="row g-3 needs-validation" action="{{ route('admin.dosen.store') }}" method="POST"
                                enctype="multipart/form-data" novalidate>
                                @csrf
                                <div class="col-12">
                                    <label for="nama" class="form-label">Nama</label>
                                    <input type="text" name="nama" class="form-control" id="nama" required>
                                    <div class="invalid-feedback">Masukkan Nama!</div>
                                </div>

                                <div class="col-12">
                                    <label for="nidn" class="form-label">NIDN</label>
                                    <input type="text" name="nidn" class="form-control" id="nidn">
                                    <div class="invalid-feedback">Masukkan NIDN!</div>
                                </div>

                                <div class="mb-3">
                                    <label for="id_matkul" class="form-label">Mata Kuliah</label>
                                    <select name="id_matkul" id="id_matkul" class="form-control" required>
                                        <option value="">-- Pilih Mata Kuliah --</option>
                                        @foreach ($mataKuliah as $matkul)
                                            <option value="{{ $matkul->id_matkul }}">{{ $matkul->nama_matkul }}</option>
                                        @endforeach
                                    </select>
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
