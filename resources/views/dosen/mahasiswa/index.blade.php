@extends('dosen.layouts.template')

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
                    <li class="breadcrumb-item"><a href="{{ route('dosen.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Daftar Mahasiswa</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <form action="{{ route('dosen.mahasiswa.index') }}" method="GET">
                                <select name="angkatan" class="form-select" onchange="this.form.submit()">
                                    <option value="">-- Pilih Angkatan --</option>
                                    @foreach ($angkatanList as $item)
                                        <option value="{{ $item->angkatan }}"
                                            {{ $angkatan == $item->angkatan ? 'selected' : '' }}>
                                            {{ $item->angkatan }}
                                        </option>
                                    @endforeach
                                </select>
                            </form>
                        </div>
                        <div class="card-body">
                            <!-- Table with stripped rows -->
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
                                    @foreach ($mahasiswa as $mhs)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $mhs->nama }}</td>
                                            <td>{{ $mhs->nim }}</td>
                                            <td>{{ $mhs->angkatan }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>

@endsection
