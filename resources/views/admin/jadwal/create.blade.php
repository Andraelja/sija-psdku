@extends('admin.layouts.template')

@section('title', 'Tambah Jadwal Kuliah - SIJA')

@section('content')

    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Tambah Jadwal Kuliah</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.jadwal.index') }}">Jadwal Kuliah</a></li>
                    <li class="breadcrumb-item active">Tambah Jadwal</li>
                </ol>
            </nav>
        </div>

        <section class="section">
            <div class="card">
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.jadwal.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Mata Kuliah</label>
                            <select name="id_matkul" class="form-control" required>
                                <option value="" disabled selected>Pilih Mata Kuliah</option>
                                @foreach ($matkul as $m)
                                    <option value="{{ $m->id_matkul }}">{{ $m->nama_matkul }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Nama Dosen</label>
                            <select name="id_dosen" class="form-control" required>
                                <option value="" disabled selected>Pilih Dosen</option>
                                @foreach ($dosen as $d)
                                    <option value="{{ $d->id_dosen }}">{{ $d->nama }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Ruangan</label>
                            <input type="text" name="ruangan" class="form-control" value="{{ old('ruangan') }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Hari</label>
                            <select name="hari" class="form-control" required>
                                <option value="" disabled selected>Pilih Hari</option>
                                <option value="Senin">Senin</option>
                                <option value="Selasa">Selasa</option>
                                <option value="Rabu">Rabu</option>
                                <option value="Kamis">Kamis</option>
                                <option value="Jumat">Jumat</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Jam Mulai</label>
                            <input type="time" name="jam_mulai" class="form-control" value="{{ old('jam_mulai') }}"
                                required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Jam Selesai</label>
                            <input type="time" name="jam_selesai" class="form-control" value="{{ old('jam_selesai') }}"
                                required>
                        </div>

                        <div class="col-12">
                            <label for="angkatan" class="form-label">Angkatan</label>
                            <select name="angkatan" id="angkatan" class="form-select" required>
                                <option value="">Pilih Angkatan</option>
                                @foreach ($angkatanList as $item)
                                    <option value="{{ $item->angkatan }}">{{ $item->angkatan }}</option>
                                @endforeach
                            </select>
                        </div>         

                        <div class="col-12">
                            <button type="submit" class="btn btn-primary ">Simpan</button>
                            <a href="{{ route('admin.jadwal.index') }}" class="btn btn-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </main>

@endsection
