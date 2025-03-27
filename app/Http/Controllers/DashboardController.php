<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    public function indexDosen()
    {
        return view('dosen.dashboard');
    }

    public function dashboardDosen()
    {
        $dosen = \App\Models\Dosen::where('nidn', auth()->user()->username)->first();
        return view('dosen.dashboard', compact('dosen'));
    }

    public function dashboardMahasiswa()
    {
        $mahasiswa = \App\Models\Mahasiswa::where('nim', auth()->user()->username)->first();
        return view('mahasiswa.dashboard', compact('mahasiswa'));
    }

}
