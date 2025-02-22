@extends('dosen.layouts.template')

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
                <li class="breadcrumb-item"><a href="{{ route('dosen.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Daftar Matkul</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <form action="{{ route('dosen.matkul.index') }}" method="GET">
                            <select name="angkatan" class="form-select" onchange="this.form.submit()">
                                <option value="">-- Pilih Angkatan --</option>
                                @foreach ($angkatanList as $item)
                                    <option value="{{ $item->angkatan }}" {{ $angkatan == $item->angkatan ? 'selected' : '' }}>
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
            </div>
        </div>
    </section>

</main>

@endsection
