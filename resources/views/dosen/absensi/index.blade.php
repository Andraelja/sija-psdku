@extends('dosen.layouts.template')

@section('title', 'Absensi Mahasiswa')

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Absensi Mahasiswa</h1>
        </div>

        <section class="section">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('dosen.absensi.create') }}" method="GET">
                        <div class="mb-3">
                            <label for="angkatan" class="form-label">Angkatan</label>
                            <select class="form-control" id="angkatan" name="angkatan" required>
                                <option value="">-- Pilih Angkatan --</option>
                                @foreach ($angkatan as $a)
                                    <option value="{{ $a }}">{{ $a }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="id_matkul" class="form-label">Mata Kuliah</label>
                            <select class="form-control" id="id_matkul" name="id_matkul" required disabled>
                                <option value="">-- Pilih Mata Kuliah --</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="tanggal" class="form-label">Tanggal</label>
                            <input type="date" class="form-control" name="tanggal" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Lanjut</button>
                    </form>
                </div>
            </div>
        </section>

    </main>

    <script>
        document.getElementById('angkatan').addEventListener('change', function() {
            let angkatan = this.value;
            let matkulDropdown = document.getElementById('id_matkul');

            matkulDropdown.innerHTML = '<option value="">-- Pilih Mata Kuliah --</option>';
            matkulDropdown.disabled = true;

            if (angkatan) {
                fetch(`/dosen/absensi/matkul/${angkatan}`)
                    .then(response => response.json())
                    .then(data => {
                        data.forEach(matkul => {
                            let option = document.createElement('option');
                            option.value = matkul.id_matkul;
                            option.textContent = matkul.nama_matkul;
                            matkulDropdown.appendChild(option);
                        });
                        matkulDropdown.disabled = false;
                    })
                    .catch(error => console.error('Error:', error));
            }
        });
    </script>

@endsection
