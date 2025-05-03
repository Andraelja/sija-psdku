<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DosenController extends Controller
{
    public function index()
    {
        $dosen = DB::table('dosen')->get();
        return view('admin.dosen.index', compact('dosen'));
    }


    public function create()
    {
        return view('admin.dosen.create');
    }

    public function store(Request $request)
    {
        $dosen = DB::table('dosen')->insertGetId([
            'nama' => $request->nama,
            'nidn' => $request->nidn,
            'email' => $request->email,
        ]);

        DB::table('users')->insert([
            'username' => $request->nidn,
            'password' => bcrypt('password'),
            'role' => 'dosen'
        ]);

        return redirect('admin/dosen/index/')->with("success", "Data Dosen Berhasil Ditambahkan!");
    }

    public function edit($id)
    {
        $dosen = DB::table('dosen')->where('id_dosen', $id)->first();
        return view('admin.dosen.edit', compact('dosen'));
    }

    public function update(Request $request, string $id)
    {
        $validasiData = $request->validate([
            'nama' => 'required|string|max:255',
            'nidn' => 'required|string|max:255',
        ]);

        DB::table('dosen')->where('id_dosen', $id)->update($validasiData);

        return redirect()->route('admin.dosen.index')->with('success', 'Berhasil memperbarui dosen!');
    }

    public function destroy(string $id)
    {
        DB::table('dosen')->where('id_dosen', $id)->delete();
        return redirect()->route('admin.dosen.index')->with('success', 'Berhasil menghapus dosen!');
    }
}
