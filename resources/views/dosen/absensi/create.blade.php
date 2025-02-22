@extends('dosen.layouts.template')

@section('title', 'Form Absensi Mahasiswa')

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Form Absensi</h1>
        </div>

        <section class="section">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('dosen.absensi.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id_matkul" value="{{ $id_matkul }}">
                        <input type="hidden" name="tanggal" value="{{ $tanggal }}">

                        <table class="table table-bordered">
                            <thead class="table-primary">
                                <tr>
                                    <th>No.</th>
                                    <th>Nama Mahasiswa</th>
                                    <th>Hadir</th>
                                    <th>Izin</th>
                                    <th>Sakit</th>
                                    <th>Alfa</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($mahasiswa as $key => $mhs)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $mhs->nama }}</td>
                                        <td>
                                            <input type="radio" name="absensi[{{ $mhs->id_mahasiswa }}]" value="Hadir"
                                                required>
                                        </td>
                                        <td>
                                            <input type="radio" name="absensi[{{ $mhs->id_mahasiswa }}]" value="Izin">
                                        </td>
                                        <td>
                                            <input type="radio" name="absensi[{{ $mhs->id_mahasiswa }}]" value="Sakit">
                                        </td>
                                        <td>
                                            <input type="radio" name="absensi[{{ $mhs->id_mahasiswa }}]" value="Alfa">
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <button type="submit" class="btn btn-success">Simpan Absensi</button>
                    </form>
                </div>
            </div>
        </section>

    </main>
@endsection
