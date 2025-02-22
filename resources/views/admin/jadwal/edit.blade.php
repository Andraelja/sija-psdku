@extends('admin.layouts.template')

@section('title', 'Edit Jadwal Kuliah')

@section('content')
    <main id="main" class="main">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="pagetitle">
            <h1>Edit Jadwal Kuliah</h1>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('admin.jadwal.update', $jadwal->id_jadwal) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="mb-3">
                                    <label for="id_matkul" class="form-label">Mata Kuliah</label>
                                    <select name="id_matkul" id="id_matkul" class="form-control" required>
                                        <option value="">Pilih Mata Kuliah</option>
                                        @foreach ($matkul as $mk)
                                            <option value="{{ $mk->id_matkul }}"
                                                {{ $jadwal->id_matkul == $mk->id_matkul ? 'selected' : '' }}>
                                                {{ $mk->nama_matkul }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="id_dosen" class="form-label">Dosen Pengajar</label>
                                    <select name="id_dosen" id="id_dosen" class="form-control" required>
                                        <option value="">Pilih Dosen</option>
                                        @foreach ($dosen as $d)
                                            <option value="{{ $d->id_dosen }}"
                                                {{ $jadwal->id_dosen == $d->id_dosen ? 'selected' : '' }}>
                                                {{ $d->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="ruangan" class="form-label">Ruangan</label>
                                    <input type="text" name="ruangan" class="form-control"
                                        value="{{ old('ruangan', $jadwal->ruangan) }}" required>
                                </div>

                                <div class="mb-3">
                                    <label for="hari" class="form-label">Hari</label>
                                    <select name="hari" id="hari" class="form-control" required>
                                        <option value="">Pilih Hari</option>
                                        @php
                                            $hariList = [
                                                'Senin',
                                                'Selasa',
                                                'Rabu',
                                                'Kamis',
                                                'Jumat',
                                            ];
                                        @endphp
                                        @foreach ($hariList as $hariOption)
                                            <option value="{{ $hariOption }}"
                                                {{ $jadwal->hari == $hariOption ? 'selected' : '' }}>
                                                {{ $hariOption }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="jam_mulai" class="form-label">Jam Mulai</label>
                                    <input type="time" name="jam_mulai" class="form-control"
                                        value="{{ old('jam_mulai', $jadwal->jam_mulai) }}" required>
                                </div>

                                <div class="mb-3">
                                    <label for="jam_selesai" class="form-label">Jam Selesai</label>
                                    <input type="time" name="jam_selesai" class="form-control"
                                        value="{{ old('jam_selesai', $jadwal->jam_selesai) }}" required>
                                </div>

                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
