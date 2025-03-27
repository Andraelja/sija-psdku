@extends('mahasiswa.layouts.template')

@section('title', 'Daftar Mahasiswa - SIJA - PSDKU')

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
            <h1>Data Mahasiswa</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('mahasiswa.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Daftar Mahasiswa</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <form action="{{ route('mahasiswa.mahasiswa.index') }}" method="GET">
                                <div class="input-group">
                                    <select name="angkatan" class="form-select" onchange="this.form.submit()">
                                        <option value="">-- Pilih Angkatan --</option>
                                        @foreach ($angkatanList as $item)
                                            <option value="{{ $item->angkatan }}"
                                                {{ $angkatan == $item->angkatan ? 'selected' : '' }}>
                                                {{ $item->angkatan }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </form>
                        </div>
                        <div class="card-body">
                            @if ($angkatan)
                                <!-- Tampilkan tabel hanya jika angkatan dipilih -->
                                <table class="table table-striped datatable">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Nama</th>
                                            <th>NIM</th>
                                            <th>Angkatan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($mahasiswa as $mhs)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $mhs->nama }}</td>
                                                <td>{{ $mhs->nim }}</td>
                                                <td>{{ $mhs->angkatan }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="text-center">Tidak ada data mahasiswa untuk
                                                    angkatan ini.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            @else
                                <!-- Tampilkan pesan jika angkatan belum dipilih -->
                                <div class="alert alert-info text-center">
                                    Silakan pilih angkatan terlebih dahulu untuk melihat data mahasiswa.
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

@endsection
