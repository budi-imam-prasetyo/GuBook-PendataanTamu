<?php

namespace App\Http\Controllers;

use App\Models\KedatanganTamu;
use Illuminate\Http\Request;
use App\Models\Pegawai;
use App\Models\Tamu;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use DNS2D;
// use Milon\Barcode\DNS2D;

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
        $listpegawai = Pegawai::paginate(10);
        $listpegawai->withPath('/list-pegawai');
        $listmapel = Pegawai::pluck('PTK');
        return view('user.listPegawai', compact('listpegawai', 'listmapel'));
    }


    public function storeTamu(Request $request)
    {
        // dd($request->all());

        $validator = Validator::make($request->all(), [
            'nama' => 'required|string',
            'alamat' => 'required|string',
            'no_telpon' => 'required|string',
            'email' => 'required|email',
            'instansi' => 'required|string',
            'NIP' => 'required|exists:pegawai,NIP',
            'tujuan' => 'required|string',
            'waktu_perjanjian' => 'required|date',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $tamu = new Tamu();
        $tamu->nama = $request->nama;
        $tamu->email = $request->email;
        $tamu->alamat = $request->alamat;
        $tamu->no_telpon = $request->no_telpon;
        $tamu->save();

        $pegawai = Pegawai::all()->first();
        // if (!$pegawai) {
        //     return redirect()->back()->withErrors(['message' => 'Pegawai tidak ditemukan'])->withInput();
        // }
        $id_user = $pegawai->user->id;

        $kedatanganTamu = new KedatanganTamu();
        $kedatanganTamu->id_tamu = $tamu->id;
        $kedatanganTamu->NIP = $request->pegawai;
        // dd($kedatanganTamu->id_user);
        $kedatanganTamu->id_user = $id_user;
        $kedatanganTamu->instansi = $request->instansi;
        $kedatanganTamu->tujuan = $request->tujuan;
        $kedatanganTamu->waktu_perjanjian = $request->waktu_perjanjian;
        $kedatanganTamu->waktu_kedatangan = null;


        $requestData = [
            'nama' => $request->nama,
            'email' => $request->email,
            'alamat' => $request->alamat,
            'no_telpon' => $request->no_telpon,
            'pegawai' => $request->pegawai,
            'instansi' => $request->instansi,
            'tujuan' => $request->tujuan,
            'waktu_perjanjian' => $request->waktu_perjanjian
        ];
        $qrCodeContent = json_encode($requestData);
        $qrCodeHtml = DNS2D::getBarcodePNG($qrCodeContent, 'QRCODE');
        $kedatanganTamu->qr_code = $qrCodeHtml;

        $kedatanganTamu->save();

        return response()->json([
            'success' => true,
            'qr_code' => $qrCodeHtml
        ]);

    }

    public function storeKurir(Request $request)
    {
        
    }


    public function about(){
        return view('user.about');
    }

}