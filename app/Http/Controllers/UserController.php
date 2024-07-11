<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pegawai;

class UserController extends Controller
{
    public function formTamu()
    {
        $listpegawai = Pegawai::all();
        return view('user.formTamu', compact('listpegawai'));
    }
    
    public function formKurir()
    {
        $listpegawai = Pegawai::all();
        return view('user.formKurir', compact('listpegawai'));
    }
    public function listPegawai()
    {
        $listpegawai = Pegawai::take(10)->get();
        $listmapel = Pegawai::pluck('PTK');
        $total = Pegawai::count();
        return view('user.listPegawai', compact('listmapel', 'listpegawai', 'total'));
    }
    public function loadlist(Request $request){
        if($request->ajax()){
            $skip = $request->skip;
            $listpegawai = Pegawai::skip($skip)->take(15)->get();
            return view('user.listPegawaiAll', compact('listpegawai'))->render();
            
        }
    }

    public function search(Request $request){
        $search = $request->search;
        $listmapel = Pegawai::pluck('PTK');
        $total = Pegawai::count();
        $listpegawai = Pegawai::where(function($query) use ($search){
            $query->where('NIP','like',"%$search%")
            ->orWhere('PTK','like',"%$search%");
        })
        ->orWhereHas('user',function($query) use($search){
            $query->where('name','like',"%$search%")
            ->orWhere('email','like',"%$search%");
        })
        ->get();
        return view('user.listPegawai', compact('listpegawai', 'search', 'listmapel', 'total'));
    }

    public function about(){
        return view('user.about');
    }

}