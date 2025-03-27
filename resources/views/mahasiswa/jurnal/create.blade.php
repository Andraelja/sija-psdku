@extends('dosen.layouts.template')

@section('title', 'Tambah Jurnal Perkuliahan')

@section('content')

    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Tambah Jurnal Perkuliahan</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('dosen.jurnal.index') }}">Jurnal Perkuliahan</a></li>
                    <li class="breadcrumb-item active">Tambah</li>
                </ol>
            </nav>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('dosen.jurnal.store') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="id_jadwal" class="form-label">Mata Kuliah</label>
                                    <select name="id_jadwal" id="id_jadwal" class="form-control" required>
                                        <option value="">-- Pilih Mata Kuliah --</option>
                                        @foreach ($jadwalKuliah as $jadwal)
                                            <option value="{{ $jadwal->id_jadwal }}">{{ $jadwal->matkul->nama_matkul }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="id_dosen" class="form-label">Dosen</label>
                                    <input type="text" name="id_dosen" id="id_dosen" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label for="materi" class="form-label">Materi</label>
                                    <input type="text" name="materi" id="materi" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label for="tanggal" class="form-label">Tanggal</label>
                                    <input type="date" name="tanggal" id="tanggal" class="form-control" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <a href="{{ route('dosen.jurnal.index') }}" class="btn btn-secondary">Batal</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

@endsection
