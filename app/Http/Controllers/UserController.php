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
    public function listPegawai()
    {
        $listpegawai = Pegawai::take(10)->get();
        $listmapel = Pegawai::pluck('PTK');
        return view('listPegawai', compact('listmapel', 'listpegawai'));
    }
    public function loadlist(Request $request){
        if($request->ajax()){
            $skip = $request->skip;
            $listpegawai = Pegawai::skip($skip)->take(15)->get();
            return view('listPegawaiAll', compact('listpegawai'))->render();
            
        }
    }

}