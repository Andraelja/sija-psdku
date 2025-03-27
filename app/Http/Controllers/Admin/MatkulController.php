<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MatkulController extends Controller
{
    public function index(Request $request)
    {
        $angkatan = $request->input('angkatan');
        $angkatanList = DB::table('mahasiswa')->select('angkatan')->distinct()->get();

        $query = DB::table('mata_kuliah')
            ->leftJoin('dosen', 'mata_kuliah.id_dosen', '=', 'dosen.id_dosen')
            ->select('mata_kuliah.*', 'dosen.nama as nama_dosen');

        if ($angkatan) {
            $query->where('mata_kuliah.angkatan', $angkatan);
        }

        $matkul = $query->get();

        return view('admin.matkul.index', compact('matkul', 'angkatanList', 'angkatan'));
    }

    public function create()
    {
        $dosen = DB::table('dosen')->get();
        $angkatanList = DB::table('mahasiswa')->select('angkatan')->distinct()->get();
        return view('admin.matkul.create', compact('dosen', 'angkatanList'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_matkul' => 'required|string|max:255',
            'sks' => 'required|integer|min:1|max:6',
            'id_dosen' => 'nullable|exists:dosen,id_dosen',
            'angkatan' => 'required|string',
        ]);

        DB::table('mata_kuliah')->insert([
            'nama_matkul' => $request->nama_matkul,
            'sks' => $request->sks,
            'id_dosen' => $request->id_dosen,
            'angkatan' => $request->angkatan,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('admin.matkul.index')->with('success', 'Mata Kuliah berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $matkul = DB::table('mata_kuliah')->where('id_matkul', $id)->first();
        $dosen = DB::table('dosen')->get();

        if (!$matkul) {
            return redirect()->route('admin.matkul.index')->with('error', 'Mata Kuliah tidak ditemukan!');
        }

        return view('admin.matkul.edit', compact('matkul', 'dosen'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_matkul' => 'required|string|max:255',
            'sks' => 'required|integer|min:1|max:6',
            'id_dosen' => 'nullable|exists:dosen,id_dosen',
        ]);

        $updated = DB::table('mata_kuliah')
            ->where('id_matkul', $id)
            ->update([
                'nama_matkul' => $request->nama_matkul,
                'sks' => $request->sks,
                'id_dosen' => $request->id_dosen,
                'updated_at' => now(),
            ]);

        return redirect()->route('admin.matkul.index')->with('success', 'Mata Kuliah berhasil diubah!');
    }

    public function destroy($id)
    {
        $deleted = DB::table('mata_kuliah')->where('id_matkul', $id)->delete();
        return redirect()->route('admin.matkul.index')->with('success', 'Mata Kuliah berhasil dihapus!');
    }
}
