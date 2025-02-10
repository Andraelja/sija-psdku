@extends('admin.layouts.template')

@section('title', 'Edit Dosen - SIJA - PSDKU')

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
            <h1>Edit Data Dosen</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.dosen.index') }}">Daftar Dosen</a></li>
                    <li class="breadcrumb-item active">Edit Dosen</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card mb-3">
                        <div class="card-body">
                            <form class="row g-3 needs-validation"
                                action="{{ route('admin.dosen.update', $dosen->id_dosen) }}" method="POST"
                                enctype="multipart/form-data" novalidate>
                                @csrf
                                @method('PUT')

                                <div class="col-12">
                                    <label for="nama" class="form-label">Nama</label>
                                    <input type="text" name="nama" class="form-control" id="nama"
                                        value="{{ old('nama', $dosen->nama) }}" required>
                                </div>

                                <div class="col-12">
                                    <label for="nidn" class="form-label">NIDN</label>
                                    <input type="text" name="nidn" class="form-control" id="nidn"
                                        value="{{ old('nidn', $dosen->nidn) }}">
                                </div>

                                <div class="mb-3">
                                    <label for="id_matkul" class="form-label">Mata Kuliah</label>
                                    <select name="id_matkul" id="id_matkul" class="form-control" required>
                                        <option value="">-- Pilih Mata Kuliah --</option>
                                        @foreach ($mataKuliah as $matkul)
                                            <option value="{{ $matkul->id_matkul }}"
                                                {{ $dosen->id_matkul == $matkul->id_matkul ? 'selected' : '' }}>
                                                {{ $matkul->nama_matkul }}
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
