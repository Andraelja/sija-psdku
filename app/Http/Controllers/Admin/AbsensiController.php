<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AbsensiController extends Controller
{
    public function index(Request $request)
    {
        $angkatan = $request->input('angkatan');
        $tanggal = $request->input('tanggal');
        $id_matkul = $request->input('id_matkul');

        $query = DB::table('absensi')
            ->join('mahasiswa', 'absensi.id_mahasiswa', '=', 'mahasiswa.id_mahasiswa')
            ->join('mata_kuliah', 'absensi.id_matkul', '=', 'mata_kuliah.id_matkul')
            ->select(
                'absensi.*',
                'mahasiswa.nama as nama_mahasiswa',
                'mahasiswa.angkatan as angkatan_mahasiswa',
                'mata_kuliah.nama_matkul'
            )
            ->orderBy('absensi.id_matkul', 'asc')
            ->orderBy('absensi.tanggal', 'desc');

        //Filter
        if (!empty($angkatan)) {
            $query->where('mahasiswa.angkatan', $angkatan);
        }

        if (!empty($tanggal)) {
            $query->where('absensi.tanggal', $tanggal);
        }

        if (!empty($id_matkul)) {
            $query->where('absensi.id_matkul', $id_matkul);
        }

        $absensi = $query->get();

        $listAngkatan = DB::table('mahasiswa')
            ->distinct()
            ->orderBy('angkatan', 'DESC')
            ->pluck('angkatan')
            ->toArray();

        $listMatkul = DB::table('mata_kuliah')
            ->when($angkatan, function ($query) use ($angkatan) {
                return $query->whereIn('id_matkul', function ($subquery) use ($angkatan) {
                    $subquery->select('id_matkul')
                        ->from('absensi')
                        ->join('mahasiswa', 'absensi.id_mahasiswa', '=', 'mahasiswa.id_mahasiswa')
                        ->where('mahasiswa.angkatan', $angkatan);
                });
            })
            ->orderBy('nama_matkul', 'asc')
            ->get();

        return view('admin.absensi.index', compact('absensi', 'listAngkatan', 'listMatkul', 'angkatan', 'tanggal', 'id_matkul'));
    }
}
