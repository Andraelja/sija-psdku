@extends('dosen.layouts.template')

@section('title', 'Daftar Dosen - SIJA - PSDKU')

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
        <h1>Data Dosen</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dosen.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Daftar Dosen</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <!-- Table with stripped rows -->
                        <table class="table table-striped datatable">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama</th>
                                    <th>NIDN</th>
                                    <th>Email</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($dosen as $key => $d)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $d->nama }}</td>
                                        <td>{{ $d->nidn }}</td>
                                        <td>{{ $d->email }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">Tidak ada data dosen.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main>

@endsection
