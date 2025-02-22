@extends('admin.layouts.template')

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
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Daftar Mahasiswa</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <a href="{{ route('admin.mahasiswa.create') }}" class="btn btn-primary" role="button">Tambah
                                Data</a>
                            <form action="{{ route('admin.mahasiswa.index') }}" method="GET">
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
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($mahasiswa as $mhs)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $mhs->nama }}</td>
                                            <td>{{ $mhs->nim }}</td>
                                            <td>{{ $mhs->angkatan }}</td>
                                            <td>
                                                <a href="{{ route('admin.mahasiswa.edit', $mhs->id_mahasiswa) }}"
                                                    class="btn btn-warning btn-sm">Edit</a>
                                                <form action="{{ route('admin.mahasiswa.destroy', $mhs->id_mahasiswa) }}"
                                                    method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Apakah Anda yakin ingin menghapus mahasiswa ini?')">Hapus</button>
                                                </form>
                                            </td>
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
