<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Models\Matkul;
use Illuminate\Http\Request;

class FormMatkulDosenController extends Controller
{
    public function index(Request $request)
    {
        $angkatan = $request->input('angkatan');
        $angkatanList = \App\Models\Mahasiswa::select('angkatan')->distinct()->get();

        $query = Matkul::with('dosen');

        if ($angkatan) {
            $query->where('angkatan', $angkatan);
        }

        $matkul = $query->get();

        return view('dosen.matkul.index', compact('matkul', 'angkatanList', 'angkatan'));
    }
}
