@extends('mahasiswa.layouts.template')

@section('title', 'Jadwal Kuliah - Dosen')

@section('content')

    <main id="main" class="main">
        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger" role="alert">
                {{ session('error') }}
            </div>
        @endif

        <div class="pagetitle">
            <h1>Jadwal Kuliah</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('mahasiswa.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Jadwal Kuliah</li>
                </ol>
            </nav>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <!-- Pilih Angkatan -->
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Pilih Angkatan</h5>
                        </div>
                        <div class="card-body">
                            <form method="GET" action="{{ route('mahasiswa.jadwal.index') }}" class="row g-3">
                                <div class="col-md-4">
                                    <label for="angkatan" class="form-label">Pilih Angkatan</label>
                                    <select name="angkatan" id="angkatan" class="form-select" required
                                        onchange="this.form.submit()">
                                        <option value="">-- Pilih Angkatan --</option>
                                        @foreach ($listAngkatan as $thn)
                                            <option value="{{ $thn }}"
                                                {{ request('angkatan') == $thn ? 'selected' : '' }}>
                                                {{ $thn }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Tabel Jadwal Kuliah: Hanya muncul jika angkatan dipilih -->
                    @if (request('angkatan'))
                        <div class="card mt-4">
                            <div class="card-header bg-primary text-white">
                                <h5 class="mb-0">Jadwal Kuliah - Angkatan {{ request('angkatan') }}</h5>
                            </div>
                            <div class="card-body">
                                @php
                                    $hariList = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'];
                                @endphp

                                @foreach ($hariList as $hari)
                                    @if (isset($jadwal[$hari]) && $jadwal[$hari]->count() > 0)
                                        <h4 class="mt-3">{{ $hari }}</h4>
                                        <div class="table-responsive">
                                            <table class="table table-striped datatable">
                                                <thead class="table-primary">
                                                    <tr>
                                                        <th>No.</th>
                                                        <th>Nama Matkul</th>
                                                        <th>Dosen Pengampu</th>
                                                        <th>Ruangan</th>
                                                        <th>Jam</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($jadwal[$hari]->sortBy('jam_mulai') as $index => $j)
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ $j->matkul->nama_matkul }}</td>
                                                            <td>{{ $j->dosen->nama ?? '-' }}</td>
                                                            <td>{{ $j->ruangan }}</td>
                                                            <td>{{ $j->jam_mulai }} - {{ $j->jam_selesai }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    @endif
                                @endforeach

                                @if (empty($jadwal) || collect($jadwal)->flatten()->isEmpty())
                                    <p class="text-center mt-3">Tidak ada jadwal kuliah untuk angkatan ini.</p>
                                @endif
                            </div>
                        </div>
                    @else
                        <div class="alert alert-info mt-4" role="alert">
                            Silakan pilih angkatan terlebih dahulu untuk melihat jadwal kuliah.
                        </div>
                    @endif
                </div>
            </div>
        </section>
    </main>

@endsection
