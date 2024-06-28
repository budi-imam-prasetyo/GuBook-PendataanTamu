<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pegawai;

class UserController extends Controller
{
    public function formTamu()
    {
        $listpegawai = Pegawai::all();
        return view('formTamu', compact('listpegawai'));
    }
    
    public function formKurir()
    {
        $listpegawai = Pegawai::all();
        return view('formKurir', compact('listpegawai'));
    }

}