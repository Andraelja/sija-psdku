@extends('admin.layouts.template')

@section('title', 'Data Absensi Mahasiswa - SIJA')

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
            <h1>Data Absensi</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Daftar Absensi</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="container">
                <div class="card shadow-lg border-0">
                    <div class="card-body mt-2">
                        <form action="{{ route('admin.absensi.index') }}" method="GET" class="row g-3 align-items-end">
                            <div class="col-md-4">
                                <label for="tanggal" class="form-label">Pilih Tanggal</label>
                                <input type="date" class="form-control border-primary" name="tanggal"
                                    value="{{ request('tanggal', \Carbon\Carbon::now()->toDateString()) }}">
                            </div>
                            <div class="col-md-4">
                                <label for="angkatan" class="form-label">Pilih Angkatan</label>
                                <select class="form-select border-primary" name="angkatan" id="angkatan">
                                    <option value="">Semua Angkatan</option>
                                    @foreach ($listAngkatan as $item)
                                        <option value="{{ $item }}"
                                            {{ request('angkatan') == $item ? 'selected' : '' }}>
                                            {{ $item }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 text-center">
                                <button type="submit" class="btn btn-primary text-white">Filter</button>
                                <a href="{{ route('admin.absensi.index') }}" class="btn btn-secondary">Reset</a>
                            </div>
                        </form>
                    </div>
                </div>

                @php
                    $tanggalFilter = request('tanggal', \Carbon\Carbon::now()->toDateString());
                    $absensiByAngkatan = $absensi->where('tanggal', $tanggalFilter)->groupBy('angkatan_mahasiswa');
                @endphp

                <div class="card mt-4 shadow-lg border-0">
                    {{-- <div class="card-header bg-primary text-white text-center py-3 rounded">
                        <h5 class="mb-0">Absensi Mahasiswa -
                            {{ \Carbon\Carbon::parse($tanggalFilter)->translatedFormat('l, d F Y') }} <br>
                            Angkatan {{ $angkatan }}
                        </h5>
                    </div> --}}
                    <div class="card-body mt-2">
                        @if ($absensiByAngkatan->isEmpty())
                            <div class="alert alert-info text-center my-3" role="alert">
                                Tidak ada data absensi untuk tanggal ini.
                            </div>
                        @else
                            @foreach ($absensiByAngkatan as $angkatan => $absensiAngkatan)
                                <div class="card mt-4 shadow-sm border-0">
                                    <div class="card-body">
                                        @php
                                            $matkulByAngkatan = $absensiAngkatan->groupBy('matkul.id_matkul');
                                        @endphp
                                        @foreach ($matkulByAngkatan as $matkulId => $absensiMatkul)
                                            <div class="mb-5">
                                                <h3 class="text-primary">Mata Kuliah:
                                                    {{ $absensiMatkul->first()->nama_matkul ?? '-' }}</h3>
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
                                                                    <td>{{ $a->nama_mahasiswa ?? '-' }}</td>
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
        </section>
    </main>
@endsection
