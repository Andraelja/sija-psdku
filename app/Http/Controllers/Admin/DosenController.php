<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Dosen;
use App\Models\User;

class DosenController extends Controller
{
    public function index()
    {
        $dosen = Dosen::all();
        return view('admin.dosen.index', compact('dosen'));
    }


    public function create()
    {
        return view('admin.dosen.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nidn' => 'required|unique:dosen,nidn',
            'email' => 'required|email|unique:dosen,email',
        ]);

        // Tambahkan data dosen
        Dosen::create([
            'nama' => $request->nama,
            'nidn' => $request->nidn,
            'email' => $request->email,
            'password' => bcrypt('password'),
        ]);

        User::create([
            'username' => $request->nidn,
            'password' => bcrypt('password'),
            'role' => 'dosen',
        ]);

        return redirect()->route('admin.dosen.index')->with('success', 'Berhasil menambahkan dosen dan akun!');
    }

    public function edit($id)
    {
        $dosen = Dosen::find($id);
        return view('admin.dosen.edit', compact('dosen'));
    }

    public function update(Request $request, string $id)
    {
        $dosen = Dosen::find($id);
        $dosen->update($request->all());

        return redirect()->route('admin.dosen.index')->with('success', 'Berhasil memperbarui dosen!');
    }

    public function destroy(string $id)
    {
        $dosen = Dosen::findOrFail($id);
        $dosen->delete();

        return redirect()->route('admin.dosen.index')->with('success', 'Berhasil menghapus dosen!');
    }

}
