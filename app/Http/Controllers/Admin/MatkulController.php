<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Matkul;

class MatkulController extends Controller
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

        return view('admin.matkul.index', compact('matkul', 'angkatanList', 'angkatan'));
    }

    public function create()
    {
        $dosen = \App\Models\Dosen::all();
        $angkatanList = \App\Models\Mahasiswa::select('angkatan')->distinct()->get();
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

        $matkul = Matkul::create([
            'nama_matkul' => $request->nama_matkul,
            'sks' => $request->sks,
            'id_dosen' => $request->id_dosen,
            'angkatan' => $request->angkatan,
        ]);

        return redirect()->route('admin.matkul.index')->with('success', 'Mata Kuliah berhasil ditambahkan!');
    }


    public function edit($id)
    {
        $matkul = Matkul::findOrFail($id);
        $dosen = \App\Models\Dosen::all();
        return view('admin.matkul.edit', compact('matkul', 'dosen'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_matkul' => 'required|string|max:255',
            'sks' => 'required|integer|min:1|max:6',
            'id_dosen' => 'nullable|exists:dosen,id_dosen',
        ]);

        $matkul = Matkul::findOrFail($id);
        $matkul->update([
            'nama_matkul' => $request->nama_matkul,
            'sks' => $request->sks,
            'id_dosen' => $request->id_dosen,
        ]);

        return redirect()->route('admin.matkul.index')->with('success', 'Mata Kuliah berhasil diubah!');
    }

    public function destroy($id)
    {
        $matkul = Matkul::findOrFail($id);
        $matkul->delete();
        return redirect()->route('admin.matkul.index')->with('success', 'Mata Kuliah berhasil dihapus!');
    }
}
