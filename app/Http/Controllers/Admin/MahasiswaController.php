<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mahasiswa;

class MahasiswaController extends Controller
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
        
        return view('admin.mahasiswa.index', compact('mahasiswa', 'angkatan', 'angkatanList'));
    }

    public function create()
    {
        return view('admin.mahasiswa.create');
    }

    public function store(Request $request)
    {
        Mahasiswa::create($request->validate([
            'nama' => 'required|string|max:255',
            'nim' => 'required|string|max:20|unique:mahasiswa,nim',
            'angkatan' => 'required|integer|min:2000',
        ]));

        return redirect()->route('admin.mahasiswa.index')->with('success', 'Berhasil menambahkan mahasiswa!');
    }

    public function edit($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        return view('admin.mahasiswa.edit', compact('mahasiswa'));
    }

    public function update(Request $request, $id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        $mahasiswa->update($request->validate([
            'nama' => 'required|string|max:255',
            'nim' => 'required|string|max:20|unique:mahasiswa,nim,' . $id . ',id_mahasiswa',
            'angkatan' => 'required|integer|min:2000',
        ]));

        return redirect()->route('admin.mahasiswa.index')->with('success', 'Berhasil memperbarui mahasiswa!');
    }

    public function destroy($id)
    {
        Mahasiswa::findOrFail($id)->delete();
        return redirect()->route('admin.mahasiswa.index')->with('success', 'Berhasil menghapus mahasiswa!');
    }
}
