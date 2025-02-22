<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\Mahasiswa;
use App\Models\Matkul;
use Illuminate\Http\Request;

class FormAbsenDosenController extends Controller
{
    public function index()
    {
        $angkatan = Mahasiswa::selectRaw('YEAR(angkatan) as angkatan')->distinct()->orderBy('angkatan', 'desc')->pluck('angkatan');
        return view('dosen.absensi.index', compact('angkatan'));
    }

    public function getMatkulByAngkatan($angkatan)
    {
        $matkul = Matkul::whereHas('mahasiswa', function ($query) use ($angkatan) {
            $query->whereYear('angkatan', $angkatan);
        })->get(['id_matkul', 'nama_matkul']);

        return response()->json($matkul);
    }

    public function create(Request $request)
    {
        $request->validate([
            'id_matkul' => 'required|exists:mata_kuliah,id_matkul',
            'tanggal' => 'required|date',
        ]);

        $id_matkul = $request->id_matkul;
        $tanggal = $request->tanggal;

        $mahasiswa = Mahasiswa::whereHas('matkul', function ($q) use ($id_matkul) {
            $q->where('id_matkul', $id_matkul);
        })->get();

        return view('dosen.absensi.create', compact('mahasiswa', 'id_matkul', 'tanggal'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_matkul' => 'required|exists:mata_kuliah,id_matkul',
            'tanggal' => 'required|date',
            'absensi' => 'required|array',
        ]);

        foreach ($request->absensi as $id_mahasiswa => $status) {
            Absensi::updateOrCreate(
                [
                    'id_mahasiswa' => $id_mahasiswa,
                    'id_matkul' => $request->id_matkul,
                    'tanggal' => $request->tanggal,
                ],
                [
                    'waktu' => now()->format('H:i'),
                    'status' => $status,
                ]
            );
        }

        return redirect()->route('dosen.absensi.index')->with('success', 'Absensi berhasil disimpan!');
    }
}
