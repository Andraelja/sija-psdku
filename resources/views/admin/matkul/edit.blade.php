@extends('admin.layouts.template')

@section('title', 'Edit Mata Kuliah - SIJA - PSDKU')

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
        <h1>Edit Data Mata Kuliah</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.matkul.index') }}">Daftar Mata Kuliah</a></li>
                <li class="breadcrumb-item active">Edit Mata Kuliah</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card mb-3">
                    <div class="card-body">
                        <form class="row g-3 needs-validation"
                            action="{{ route('admin.matkul.update', $matkul->id_matkul) }}" method="POST"
                            enctype="multipart/form-data" novalidate>
                            @csrf
                            @method('PUT')

                            <div class="col-12">
                                <label for="nama_matkul" class="form-label">Nama Mata Kuliah</label>
                                <input type="text" name="nama_matkul" class="form-control" id="nama_matkul"
                                    value="{{ old('nama_matkul', $matkul->nama_matkul) }}" required>
                            </div>

                            <div class="col-12">
                                <label for="sks" class="form-label">SKS</label>
                                <input type="number" name="sks" class="form-control" id="sks"
                                    value="{{ old('sks', $matkul->sks) }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="id_dosen" class="form-label">Dosen Pengampu</label>
                                <select name="id_dosen" id="id_dosen" class="form-control" required>
                                    <option value="">-- Pilih Dosen --</option>
                                    @foreach ($dosen as $d)
                                        <option value="{{ $d->id_dosen }}"
                                            {{ $matkul->id_dosen == $d->id_dosen ? 'selected' : '' }}>
                                            {{ $d->nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-12">
                                <button class="btn btn-primary w-100" type="submit">Simpan Perubahan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main><!-- End #main -->

@endsection