@extends('admin.layouts.template')

@section('title', 'Tambah Absensi - SIJA')

@section('content')

<main id="main" class="main">
    <div class="pagetitle">
        <h1>Tambah Absensi</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.absensi.index') }}">Absensi</a></li>
                <li class="breadcrumb-item active">Tambah</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin.absensi.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="id_mahasiswa" class="form-label">Mahasiswa</label>
                                <select class="form-control" name="id_mahasiswa" required>
                                    <option value="">-- Pilih Mahasiswa --</option>
                                    @foreach ($mahasiswa as $m)
                                        <option value="{{ $m->id_mahasiswa }}">{{ $m->nama }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="id_matkul" class="form-label">Mata Kuliah</label>
                                <select class="form-control" name="id_matkul" required>
                                    <option value="">-- Pilih Mata Kuliah --</option>
                                    @foreach ($matkul as $mk)
                                        <option value="{{ $mk->id_matkul }}">{{ $mk->nama_matkul }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="tanggal" class="form-label">Tanggal</label>
                                <input type="date" class="form-control" name="tanggal" required>
                            </div>

                            <div class="mb-3">
                                <label for="waktu" class="form-label">Waktu</label>
                                <input type="time" class="form-control" name="waktu" required>
                            </div>

                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-control" name="status" required>
                                    <option value="Hadir">Hadir</option>
                                    <option value="Izin">Izin</option>
                                    <option value="Sakit">Sakit</option>
                                    <option value="Alfa">Alfa</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="{{ route('admin.absensi.index') }}" class="btn btn-secondary">Batal</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main>

@endsection
