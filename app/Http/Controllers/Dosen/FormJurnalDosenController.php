<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Models\JadwalKuliah;
use App\Models\JurnalPerkuliahan;
use Illuminate\Http\Request;

class FormJurnalDosenController extends Controller
{
    public function index()
    {
        $jurnals = JurnalPerkuliahan::with('jadwalKuliah', 'dosen')->get();
        return view('dosen.jurnal.index', compact('jurnals'));
    }

    public function create()
    {
        $jadwalKuliah = JadwalKuliah::all();
        return view('dosen.jurnal.create', compact('jadwalKuliah'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_jadwal' => 'required|exists:jadwal_kuliah,id_jadwal',
            'id_dosen' => 'required|exists:dosen,id_dosen',
            'materi' => 'required|string|max:255',
            'tanggal' => 'required|date',
        ]);

        JurnalPerkuliahan::create([
            'id_jadwal' => $request->id_jadwal,
            'id_dosen' => $request->id_dosen,
            'materi' => $request->materi,
            'tanggal' => $request->tanggal,
        ]);

        return redirect()->route('jurnal.index')->with('success', 'Jurnal berhasil ditambahkan.');
    }
}
