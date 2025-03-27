<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MahasiswaController extends Controller
{
    public function index(Request $request)
    {
        $angkatan = $request->input('angkatan');

        $query = DB::table('mahasiswa');

        if ($angkatan) {
            $query->where('angkatan', $angkatan);
        }

        $mahasiswa = $query->get();
        $angkatanList = DB::table('mahasiswa')
            ->select('angkatan')
            ->distinct()
            ->orderBy('angkatan', 'desc')
            ->get();

        return view('admin.mahasiswa.index', compact('mahasiswa', 'angkatan', 'angkatanList'));
    }

    public function create()
    {
        $mahasiswa = DB::table('mahasiswa')->get();
        return view('admin.mahasiswa.create', compact('mahasiswa'));
    }

    public function store(Request $request)
    {
        $validasiData = $request->validate([
            'nama' => 'required|string|max:255',
            'nim' => 'required|string|max:255',
            'angkatan' => 'required|integer',
        ]);

        DB::table('mahasiswa')->insert($validasiData);

        DB::table('users')->insert([
            'username' => $request->nim,
            'password' => bcrypt('password'),
            'role' => 'mahasiswa'
        ]);

        return redirect()->route('admin.mahasiswa.index')->with('success', 'Berhasil menambahkan mahasiswa!');
    }

    public function edit($id)
    {
        $mahasiswa = DB::table('mahasiswa')->where('id_mahasiswa', $id)->first();
        return view('admin.mahasiswa.edit', compact('mahasiswa'));
    }

    public function update(Request $request, $id)
    {
        $validasiData = $request->validate([
            'nama' => 'required|string|max:255',
            'nim' => 'required|string|max:255',
            'angkatan' => 'required|integer',
        ]);

        DB::table('mahasiswa')->where('id_mahasiswa', $id)->update($validasiData);

        return redirect()->route('admin.mahasiswa.index')->with('success', 'Berhasil memperbarui mahasiswa!');
    }

    public function destroy($id)
    {
        DB::table('mahasiswa')->where('id_mahasiswa', $id)->delete();
        return redirect()->route('admin.mahasiswa.index')->with('success', 'Berhasil menghapus mahasiswa!');
    }
}
