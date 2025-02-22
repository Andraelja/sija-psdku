@extends('admin.layouts.template')

@section('title', 'Data Absensi Mahasiswa - SIJA')

@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Data Absensi Mahasiswa</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Absensi</li>
                </ol>
            </nav>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Filter Data Absensi</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.absensi.index') }}" method="GET" class="row g-3">
                                <div class="col-md-4">
                                    <label for="tanggal" class="form-label">Pilih Tanggal</label>
                                    <input type="date" class="form-control" name="tanggal"
                                        value="{{ request('tanggal', \Carbon\Carbon::now()->toDateString()) }}">
                                </div>

                                <div class="col-md-4">
                                    <label for="angkatan" class="form-label">Pilih Angkatan</label>
                                    <select class="form-select" name="angkatan" id="angkatan">
                                        <option value="">Semua Angkatan</option>
                                        @foreach ($listAngkatan as $item)
                                            <option value="{{ $item }}"
                                                {{ request('angkatan') == $item ? 'selected' : '' }}>
                                                {{ $item }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-4 d-flex align-items-end">
                                    <button type="submit" class="btn btn-primary me-2">Filter</button>
                                    <a href="{{ route('admin.absensi.index') }}" class="btn btn-secondary">Reset</a>
                                </div>
                            </form>
                        </div>
                    </div>

                    @php
                        $tanggalFilter = request('tanggal', \Carbon\Carbon::now()->toDateString());
                        $absensiByAngkatan = $absensi->where('tanggal', $tanggalFilter)->groupBy('mahasiswa.angkatan');
                    @endphp

                    <div class="card mt-4">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0">Absensi Mahasiswa -
                                {{ \Carbon\Carbon::parse($tanggalFilter)->translatedFormat('l, d F Y') }}</h5>
                        </div>
                        <div class="card-body">
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

                            @if ($absensiByAngkatan->isEmpty())
                                <div class="alert alert-warning text-center my-3" role="alert">
                                    Tidak ada data absensi untuk tanggal ini.
                                </div>
                            @else
                                @foreach ($absensiByAngkatan as $angkatan => $absensiAngkatan)
                                    <div class="card mt-4">
                                        <div class="card-header bg-secondary text-white">
                                            <h5 class="mb-0">Angkatan {{ $angkatan }}</h5>
                                        </div>
                                        <div class="card-body">
                                            @php
                                                $matkulByAngkatan = $absensiAngkatan->groupBy('matkul.id_matkul');
                                            @endphp

                                            @foreach ($matkulByAngkatan as $matkulId => $absensiMatkul)
                                                <div class="mb-5">
                                                    <h3 class="text-primary">
                                                        Mata Kuliah:
                                                        {{ $absensiMatkul->first()->matkul->nama_matkul ?? '-' }}
                                                    </h3>
                                                    <div class="table-responsive">
                                                        <table class="table table-striped datatable">
                                                            <thead class="table-primary">
                                                                <tr>
                                                                    <th>No.</th>
                                                                    <th>Nama Mahasiswa</th>
                                                                    <th>Waktu</th>
                                                                    <th>Status</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($absensiMatkul as $index => $a)
                                                                    <tr>
                                                                        <td>{{ $loop->iteration }}</td>
                                                                        <td>{{ $a->mahasiswa->nama ?? '-' }}</td>
                                                                        <td>{{ $a->waktu }}</td>
                                                                        <td>
                                                                            <span
                                                                                class="badge @if ($a->status == 'Hadir') bg-success @elseif ($a->status == 'Izin') bg-warning @elseif ($a->status == 'Sakit') bg-info @else bg-danger @endif">
                                                                                {{ $a->status }}
                                                                            </span>
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
