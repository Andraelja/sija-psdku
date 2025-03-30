<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Models\Dosen;
use Illuminate\Support\Facades\DB;

class FormDosenDosenController extends Controller
{
    public function index()
    {
        $dosen = DB::table('dosen')->get();
        return view('dosen.dosen.index', compact('dosen'));
    }
}
