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
                            <h5 class="mb-0">Filter Jadwal</h5>
                            <a href="{{ route('admin.jadwal.create') }}" class="btn btn-primary">
                                <i class="bi bi-plus-circle"></i> Tambah Jadwal
                            </a>
                        </div>
                        <div class="card-body">
                            <form method="GET" action="{{ route('admin.jadwal.index') }}" class="row g-3">
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

                    @if (request('angkatan'))
                        <div class="card mt-4">
                            <div class="card-header bg-primary text-white">
                                <h5 class="mb-0">Jadwal Kuliah - Angkatan {{ request('angkatan') }}</h5>
                            </div>
                            <div class="card-body">
                                @php
                                    $hariList = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'];
                                    $jadwalByHari = $jadwal->groupBy('hari');
                                @endphp

                                @foreach ($hariList as $hari)
                                    @if (isset($jadwalByHari[$hari]) && $jadwalByHari[$hari]->count() > 0)
                                        <h5 class="mt-4">{{ $hari }}</h5>
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-hover align-middle text-center">
                                                <thead class="table-primary">
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Mata Kuliah</th>
                                                        <th>Dosen</th>
                                                        <th>Ruangan</th>
                                                        <th>Jam</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($jadwalByHari[$hari]->sortBy('jam_mulai') as $j)
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ $j->matkul }}</td>
                                                            <td>{{ $j->nama }}</td>
                                                            <td>{{ $j->ruangan }}</td>
                                                            <td>
                                                                <span class="badge bg-info text-dark">
                                                                    {{ \Carbon\Carbon::parse($j->jam_mulai)->format('H:i') }}
                                                                    -
                                                                    {{ \Carbon\Carbon::parse($j->jam_selesai)->format('H:i') }}
                                                                </span>
                                                            </td>
                                                            <td>
                                                                <a href="{{ route('admin.jadwal.edit', $j->id_jadwal) }}"
                                                                    class="btn btn-warning btn-sm">
                                                                    <i class="bi bi-pencil-square"></i>
                                                                </a>
                                                                <form
                                                                    action="{{ route('admin.jadwal.destroy', $j->id_jadwal) }}"
                                                                    method="POST" class="d-inline"
                                                                    onsubmit="return confirm('Yakin ingin menghapus?');">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="btn btn-danger btn-sm">
                                                                        <i class="bi bi-trash"></i>
                                                                    </button>
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
                                    <div class="alert alert-info text-center mt-4">
                                        Tidak ada jadwal kuliah untuk angkatan ini.
                                    </div>
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
