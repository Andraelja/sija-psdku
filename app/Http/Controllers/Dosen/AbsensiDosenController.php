<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AbsensiDosenController extends Controller
{
    public function index() {
        return view('dosen.dasboard');
    }
}
