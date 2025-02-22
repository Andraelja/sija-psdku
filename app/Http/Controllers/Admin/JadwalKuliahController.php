<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dosen;
use App\Models\JadwalKuliah;
use App\Models\Matkul;
use Illuminate\Http\Request;

class JadwalKuliahController extends Controller
{
    public function index(Request $request)
    {
        $angkatan = $request->angkatan;
        $matkulQuery = JadwalKuliah::with(['matkul', 'dosen']);

        if ($angkatan) {
            $matkulQuery->whereHas('matkul', function ($query) use ($angkatan) {
                $query->where('angkatan', $angkatan);
            });
        }

        $jadwal = $matkulQuery->get();
        $listAngkatan = Matkul::distinct()->pluck('angkatan');

        return view('admin.jadwal.index', compact('jadwal', 'listAngkatan', 'angkatan'));
    }


    public function create()
    {
        $matkul = Matkul::all();
        $dosen = Dosen::all();
        $angkatanList = \App\Models\Mahasiswa::select('angkatan')->distinct()->get();
        return view('admin.jadwal.create', compact('matkul', 'dosen', 'angkatanList'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_matkul' => 'required|exists:mata_kuliah,id_matkul',
            'id_dosen' => 'required|exists:dosen,id_dosen',
            'ruangan' => 'required|string|max:100',
            'hari' => 'required|string|max:10',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
            'angkatan' => 'required|string|max:100',
        ]);

        JadwalKuliah::create([
            'id_matkul' => $request->id_matkul,
            'id_dosen' => $request->id_dosen,
            'ruangan' => $request->ruangan,
            'hari' => $request->hari,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'angkatan' => $request->angkatan
        ]);

        return redirect()->route('admin.jadwal.index')->with('success', 'Jadwal kuliah berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $jadwal = JadwalKuliah::findOrFail($id);
        $matkul = Matkul::all();
        $dosen = Dosen::all();

        return view('admin.jadwal.edit', compact('jadwal', 'matkul', 'dosen'));
    }


    public function update(Request $request, $id)
    {
        $jadwal = JadwalKuliah::findOrFail($id);

        $updated = $jadwal->update([
            'id_matkul' => $request->id_matkul,
            'id_dosen' => $request->id_dosen,
            'ruangan' => $request->ruangan,
            'hari' => $request->hari,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
        ]);

        if ($updated) {
            return redirect()->route('admin.jadwal.index')->with('success', 'Jadwal kuliah berhasil diubah!');
        } else {
            return back()->with('error', 'Gagal mengupdate data.');
        }
    }

    public function destroy($id)
    {
        $jadwal = JadwalKuliah::findOrFail($id);
        $jadwal->delete();
        return redirect()->route('admin.jadwal.index')->with('success', 'Jadwal kuliah berhasil dihapus!');
    }

}
