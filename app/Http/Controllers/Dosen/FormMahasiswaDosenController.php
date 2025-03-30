<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FormMahasiswaDosenController extends Controller
{
    public function index(Request $request)
    {
        $angkatan = $request->input('angkatan');

        $query = DB::table('mahasiswa');

        if ($angkatan) {
            $query->where('angkatan', $angkatan);
        }

        $mahasiswa = $query->get();
        $angkatanList = DB::table('mahasiswa')
            ->select('angkatan')
            ->distinct()
            ->orderBy('angkatan', 'desc')->get();

        return view('dosen.mahasiswa.index', compact('mahasiswa', 'angkatan', 'angkatanList'));
    }
}
