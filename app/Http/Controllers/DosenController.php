<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Matkul;
use Illuminate\Http\Request;

class DosenController extends Controller
{
    public function index()
    {
        $dosen = Dosen::with('mataKuliah')->get();
        return view('admin.dosen.index', compact('dosen'));
    }


    public function create()
    {
        $mataKuliah = \App\Models\Matkul::all();
        return view('admin.dosen.create', compact('mataKuliah'));
    }


    public function store(Request $request)
    {
        Dosen::create([
            'nama' => $request->nama,
            'nidn' => $request->nidn,
            'id_matkul' => $request->id_matkul,
        ]);

        return redirect()->route(route: 'admin.dosen.index')->with('success', 'Berhasil menambahkan dosen!');
    }

    public function edit($id)
    {
        $dosen = Dosen::findOrFail($id);
        $mataKuliah = Matkul::all();

        return view('admin.dosen.edit', compact('dosen', 'mataKuliah'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nidn' => 'required|numeric|unique:dosen,nidn,' . $id . ',id_dosen', 
            'id_matkul' => 'required|exists:mata_kuliah,id_matkul', 
        ]);

        $dosen = Dosen::findOrFail($id);
        $dosen->update([
            'nama' => $request->nama,
            'nidn' => $request->nidn,
            'id_matkul' => $request->id_matkul,
        ]);

        return redirect()->route('admin.dosen.index')->with('success', 'Berhasil memperbarui dosen!');
    }

    public function destroy(string $id) {
        $dosen = Dosen::findOrFail($id);
        $dosen->delete();

        return redirect()->route('admin.dosen.index')->with('success', 'Berhasil menghapus dosen!');
    }

}
