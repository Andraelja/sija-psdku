<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Models\Dosen;
use Illuminate\Http\Request;

class FormDosenDosenController extends Controller
{
    public function index()
    {
        $dosen = Dosen::all();
        return view('dosen.dosen.index', compact('dosen'));
    }
}
