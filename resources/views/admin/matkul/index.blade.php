@extends('admin.layouts.template')

@section('title', 'Daftar Mata Kuliah - SIJA - PSDKU')

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
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Daftar Matkul</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <a href="{{ route('admin.matkul.create') }}" class="btn btn-primary">Tambah Mata Kuliah</a>
                        <form action="{{ route('admin.matkul.index') }}" method="GET">
                            <select name="angkatan" class="form-control w-auto d-inline" onchange="this.form.submit()">
                                <option value="">-- Pilih Angkatan --</option>
                                @foreach ($angkatanList as $item)
                                    <option value="{{ $item->angkatan }}" {{ request('angkatan') == $item->angkatan ? 'selected' : '' }}>
                                        {{ $item->angkatan }}
                                    </option>
                                @endforeach
                            </select>
                        </form>
                    </div>
                    <div class="card-body">
                        @php
                            $matkulByAngkatan = $matkul->groupBy('angkatan');
                        @endphp

                        @foreach ($matkulByAngkatan as $angkatan => $matkulAngkatan)
                            <h3 class="mt-4">Angkatan {{ $angkatan }}</h3>
                            <div class="table-responsive">
                                <table class="table table-striped datatable">
                                    <thead class="table-primary">
                                        <tr>
                                            <th>No.</th>
                                            <th>Nama Mata Kuliah</th>
                                            <th>SKS</th>
                                            <th>Dosen Pengampu</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($matkulAngkatan as $index => $m)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $m->nama_matkul }}</td>
                                                <td>{{ $m->sks }}</td>
                                                <td>{{ $m->dosen ? $m->dosen->nama : '-' }}</td>
                                                <td>
                                                    <a href="{{ route('admin.matkul.edit', $m->id_matkul) }}" class="btn btn-warning btn-sm">Edit</a>
                                                    <form action="{{ route('admin.matkul.destroy', $m->id_matkul) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah yakin ingin menghapus?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endforeach

                        @if ($matkul->isEmpty())
                            <p class="text-center mt-3">Tidak ada data mata kuliah.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

</main>

@endsection
