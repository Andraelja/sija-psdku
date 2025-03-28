<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JadwalKuliahController extends Controller
{
    public function index(Request $request)
    {
        $angkatan = $request->angkatan;
        $matkulQuery = DB::table('jadwal_kuliah')
            ->join('mata_kuliah', 'jadwal_kuliah.id_matkul', '=', 'mata_kuliah.id_matkul')
            ->join('dosen', 'jadwal_kuliah.id_dosen', '=', 'dosen.id_dosen')
            ->select(
                'jadwal_kuliah.*',
                'mata_kuliah.nama_matkul as matkul',
                'dosen.nama'
            );

        if ($angkatan) {
            $matkulQuery->where('mata_kuliah.angkatan', $angkatan);
        }

        $jadwal = $matkulQuery->get();
        $listAngkatan = DB::table('mata_kuliah')->distinct()->pluck('angkatan');

        return view('admin.jadwal.index', compact('jadwal', 'listAngkatan', 'angkatan'));
    }

    public function create()
    {
        $matkul = DB::table('mata_kuliah')->get();
        $dosen = DB::table('dosen')->get();
        $angkatanList = DB::table('mahasiswa')->select('angkatan')->distinct()->get();
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

        DB::table('jadwal_kuliah')->insert([
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
        $jadwal = DB::table('jadwal_kuliah')->where('id_jadwal', $id)->first();
        $matkul = DB::table('mata_kuliah')->get();
        $dosen = DB::table('dosen')->get();

        return view('admin.jadwal.edit', compact('jadwal', 'matkul', 'dosen'));
    }

    public function update(Request $request, $id)
    {
        $updated = DB::table('jadwal_kuliah')
            ->where('id_jadwal', $id)
            ->update([
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
        DB::table('jadwal_kuliah')->where('id_jadwal', $id)->delete();
        return redirect()->route('admin.jadwal.index')->with('success', 'Jadwal kuliah berhasil dihapus!');
    }
}
