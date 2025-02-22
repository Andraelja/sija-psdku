@extends('admin.layouts.template')

@section('title', 'Tambah Matkul - Schoularium')

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
            <h1>Data Dosen</h1>
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

                    <div class="card mb-3">

                        <div class="card-body">

                            <form class="row g-3 needs-validation" action="{{ route('admin.matkul.store') }}" method="POST" novalidate>
                                @csrf
                                <div class="col-12">
                                    <label for="nama_matkul" class="form-label">Nama Mata Kuliah</label>
                                    <input type="text" name="nama_matkul" class="form-control" id="nama_matkul" required>
                                    <div class="invalid-feedback">Masukkan Matkul!</div>
                                </div>
                            
                                <div class="col-12">
                                    <label for="sks" class="form-label">SKS</label>
                                    <input type="text" name="sks" class="form-control" id="sks" required>
                                    <div class="invalid-feedback">Masukkan SKS!</div>
                                </div>
                            
                                <div class="col-12">
                                    <label for="id_dosen" class="form-label">Dosen Pengampu</label>
                                    <select name="id_dosen" id="id_dosen" class="form-select">
                                        <option value="">Pilih Dosen</option>
                                        @foreach ($dosen as $d)
                                            <option value="{{ $d->id_dosen }}">{{ $d->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-12">
                                    <label for="angkatan" class="form-label">Angkatan</label>
                                    <select name="angkatan" id="angkatan" class="form-select" required>
                                        <option value="">Pilih Angkatan</option>
                                        @foreach ($angkatanList as $item)
                                            <option value="{{ $item->angkatan }}">{{ $item->angkatan }}</option>
                                        @endforeach
                                    </select>
                                </div>                                
                            
                                <div class="col-12">
                                    <button class="btn btn-primary w-100" type="submit">Tambahkan</button>
                                </div>
                            </form>                            

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main><!-- End #main -->

@endsection
