<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Absensi;
use App\Models\Mahasiswa;
use App\Models\Matkul;

class AbsensiController extends Controller
{
    public function index(Request $request)
{
    $angkatan = $request->input('angkatan');
    $tanggal = $request->input('tanggal');
    $id_matkul = $request->input('id_matkul');

    // Mengambil semua data absensi tanpa filter status tertentu
    $query = Absensi::with(['mahasiswa', 'matkul']);

    if (!empty($angkatan)) {
        $query->whereHas('mahasiswa', function ($q) use ($angkatan) {
            $q->where('angkatan', $angkatan);
        });

        $listMatkul = Matkul::whereHas('mahasiswa', function ($q) use ($angkatan) {
            $q->where('angkatan', $angkatan);
        })->orderBy('nama_matkul', 'asc')->get();
    } else {
        $listMatkul = Matkul::orderBy('nama_matkul', 'asc')->get();
    }

    if (!empty($tanggal)) {
        $query->whereDate('tanggal', $tanggal);
    }

    if (!empty($id_matkul)) {
        $query->where('id_matkul', $id_matkul);
    }

    $absensi = $query->orderBy('id_matkul', 'asc')->orderBy('tanggal', 'desc')->get();

    $listAngkatan = Mahasiswa::select('angkatan')->distinct()->orderBy('angkatan', 'desc')->pluck('angkatan')->toArray();

    return view('admin.absensi.index', compact('absensi', 'listAngkatan', 'listMatkul', 'angkatan', 'tanggal', 'id_matkul'));
}


    public function create()
    {
        $mahasiswa = Mahasiswa::all();
        $matkul = Matkul::all();
        return view('admin.absensi.create', compact('mahasiswa', 'matkul'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_mahasiswa' => 'required|exists:mahasiswa,id_mahasiswa',
            'id_matkul' => 'required|exists:mata_kuliah,id_matkul',
            'tanggal' => 'required|date',
            'waktu' => 'required|date_format:H:i',
            'status' => 'required|in:Hadir,Izin,Sakit,Alfa',
        ]);

        Absensi::create([
            'id_mahasiswa' => $request->id_mahasiswa,
            'id_matkul' => $request->id_matkul,
            'tanggal' => $request->tanggal,
            'waktu' => $request->waktu,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.absensi.index')->with('success', 'Data absensi berhasil ditambahkan!');
    }

    public function tambahDummy()
    {
        $mahasiswa = Mahasiswa::inRandomOrder()->first();
        $matkul = Matkul::inRandomOrder()->first();

        if (!$mahasiswa || !$matkul) {
            return redirect()->route('admin.absensi.index')->with('error', 'Data mahasiswa atau mata kuliah belum tersedia.');
        }

        $statusOptions = ['Hadir', 'Izin', 'Sakit', 'Alfa'];
        $status = $statusOptions[array_rand($statusOptions)];

        Absensi::create([
            'id_mahasiswa' => $mahasiswa->id_mahasiswa,
            'id_matkul' => $matkul->id_matkul,
            'tanggal' => now()->toDateString(),
            'waktu' => now()->toTimeString(),
            'status' => $status,
        ]);

        return redirect()->route('admin.absensi.index')->with('success', 'Data dummy berhasil ditambahkan!');
    }
}
