<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class FormMatkulDosenController extends Controller
{
    public function index(Request $request)
    {
        $angkatan = $request->input('angkatan');

        // Ambil data dosen yang sedang login
        $idDosen = Auth::user()->id_dosen;

        // Mengambil daftar angkatan unik dari tabel mahasiswa
        $angkatanList = DB::table('mahasiswa')->select('angkatan')->distinct()->get();

        // Query hanya untuk mata kuliah yang diajar oleh dosen yang login
        $matkul = DB::table('mata_kuliah')
            ->join('dosen', 'mata_kuliah.id_dosen', '=', 'dosen.id_dosen')
            ->where('mata_kuliah.id_dosen', Auth::user()->id);

        if ($angkatan) {
            $matkul->where('mata_kuliah.angkatan', $angkatan);
        }

        $matkul = $matkul->get();

        return view('dosen.matkul.index', compact('matkul', 'angkatanList', 'angkatan'));
    }
}
