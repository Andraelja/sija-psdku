@extends('admin.layouts.template')

@section('title', 'Jurnal Perkuliahan')

@section('content')

    <main id="main" class="main">
        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <div class="pagetitle">
            <h1>Jurnal Perkuliahan</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                    <li class="breadcrumb-item active">Jurnal Perkuliahan</li>
                </ol>
            </nav>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <a href="{{ route('admin.jurnal.create') }}" class="btn btn-primary">Tambah Jurnal</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped datatable">
                                    <thead class="table-primary">
                                        <tr>
                                            <th>No.</th>
                                            <th>Mata Kuliah</th>
                                            <th>dosen</th>
                                            <th>Materi</th>
                                            <th>Tanggal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($jurnals as $key => $jurnal)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $jurnal->jadwalKuliah->matkul->nama_matkul }}</td>
                                                <td>{{ $jurnal->dosen->nama }}</td>
                                                <td>{{ $jurnal->materi }}</td>
                                                <td>{{ $jurnal->tanggal }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @if ($jurnals->isEmpty())
                                <p class="text-center mt-3">Tidak ada jurnal perkuliahan.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

@endsection
