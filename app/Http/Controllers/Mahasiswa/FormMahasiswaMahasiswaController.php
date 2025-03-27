<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class FormMahasiswaMahasiswaController extends Controller
{
    public function index(Request $request)
    {
        $angkatan = $request->input('angkatan');

        $query = Mahasiswa::query();

        if ($angkatan) {
            $query->where('angkatan', $angkatan);
        }

        $mahasiswa = $query->get();
        $angkatanList = Mahasiswa::select('angkatan')->distinct()->orderBy('angkatan', 'desc')->get();

        return view('mahasiswa.mahasiswa.index', compact('mahasiswa', 'angkatan', 'angkatanList'));
    }
}
