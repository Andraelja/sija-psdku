@extends('mahasiswa.layouts.template')

@section('title', 'Daftar Matkul - SIJA - PSDKU')

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
        <h1>Data Mata Kuliah</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('mahasiswa.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Daftar Matkul</li>
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
                        <form action="{{ route('mahasiswa.matkul.index') }}" method="GET" class="row g-3">
                            <div class="col-md-4">
                                <label for="angkatan" class="form-label">Pilih Angkatan</label>
                                <select name="angkatan" class="form-select" required onchange="this.form.submit()">
                                    <option value="">-- Pilih Angkatan --</option>
                                    @foreach ($angkatanList as $item)
                                        <option value="{{ $item->angkatan }}" {{ request('angkatan') == $item->angkatan ? 'selected' : '' }}>
                                            {{ $item->angkatan }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Tabel Daftar Matkul: Hanya muncul jika angkatan dipilih -->
                @if (request('angkatan'))
                    <div class="card mt-4">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0">Daftar Matkul - Angkatan {{ request('angkatan') }}</h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped datatable">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama Matkul</th>
                                        <th>SKS</th>
                                        <th>Dosen Pengampu</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($matkul as $index => $m)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $m->nama_matkul }}</td>
                                            <td>{{ $m->sks }}</td>
                                            <td>{{ $m->dosen ? $m->dosen->nama : '-' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @else
                    <div class="alert alert-info mt-4" role="alert">
                        Silakan pilih angkatan terlebih dahulu untuk melihat daftar mata kuliah.
                    </div>
                @endif
            </div>
        </div>
    </section>
</main>

@endsection
