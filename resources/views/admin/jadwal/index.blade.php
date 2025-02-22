@extends('admin.layouts.template')

@section('title', 'Jadwal Kuliah - SIJA')

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
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Jadwal Kuliah</li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <a href="{{ route('admin.jadwal.create') }}" class="btn btn-primary" role="button">Tambah Jadwal</a>
                        <form method="GET" action="{{ route('admin.jadwal.index') }}" class="mb-3">
                            <select name="angkatan" id="angkatan" class="form-control d-inline w-auto" onchange="this.form.submit()">
                                <option value="">-- Pilih Angkatan --</option>
                                @foreach($listAngkatan as $thn)
                                    <option value="{{ $thn }}" {{ request('angkatan') == $thn ? 'selected' : '' }}>{{ $thn }}</option>
                                @endforeach
                            </select>
                        </form>                        
                    </div>
                    <div class="card-body">
                        @php
                            $hariList = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'];
                            $jadwalByHari = $jadwal->groupBy('hari');
                        @endphp

                        @foreach ($hariList as $hari)
                            @if (isset($jadwalByHari[$hari]) && $jadwalByHari[$hari]->count() > 0)
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
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($jadwalByHari[$hari]->sortBy('jam_mulai') as $key => $j)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $j->matkul->nama_matkul }}</td>
                                                    <td>{{ $j->dosen->nama }}</td>
                                                    <td>{{ $j->ruangan }}</td>
                                                    <td>{{ $j->jam_mulai }} - {{ $j->jam_selesai }}</td>
                                                    <td>
                                                        <a href="{{ route('admin.jadwal.edit', $j->id_jadwal) }}" class="btn btn-warning btn-sm" role="button">Edit</a>
                                                        <form action="{{ route('admin.jadwal.destroy', $j->id_jadwal) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?');">
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
                            @endif
                        @endforeach

                        @if ($jadwal->isEmpty())
                            <p class="text-center mt-3">Tidak ada data jadwal kuliah.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

@endsection
