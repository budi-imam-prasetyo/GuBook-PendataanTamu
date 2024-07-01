<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    public function index()
    {
        $listpegawai = Pegawai::all();
        return view('pegawai', compact('listpegawai'));
    }
}