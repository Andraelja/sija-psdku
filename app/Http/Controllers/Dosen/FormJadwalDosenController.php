<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Models\JadwalKuliah;
use Illuminate\Http\Request;

class FormJadwalDosenController extends Controller
{
    public function index(Request $request)
    {
        $listAngkatan = JadwalKuliah::distinct()->pluck('angkatan');

        $jadwal = JadwalKuliah::when($request->angkatan, function ($query, $angkatan) {
            return $query->where('angkatan', $angkatan);
        })
            ->orderBy('hari')
            ->orderBy('jam_mulai')
            ->get()
            ->groupBy('hari');

        return view('dosen.jadwal.index', compact('jadwal', 'listAngkatan'));
    }
}
