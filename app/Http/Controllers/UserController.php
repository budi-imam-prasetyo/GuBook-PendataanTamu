<?php

namespace App\Http\Controllers;

use App\Models\Ekspedisi;
use App\Models\KedatanganEkspedisi;
use App\Models\KedatanganTamu;
use Illuminate\Http\Request;
use App\Models\Pegawai;
use App\Models\Tamu;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Storage;
use DNS2D;

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
        $kedatanganEkspedisi = KedatanganEkspedisi::all();
        return view('user.formKurir', compact('listpegawai', 'kedatanganEkspedisi'));
    }
    public function listPegawai()
    {
        $listpegawai = Pegawai::paginate(10)->withPath('/list-pegawai');
        $startIndex = ($listpegawai->firstItem());
        $listmapel = $listpegawai->pluck('PTK');
        return view('user.listPegawai', compact('listpegawai', 'listmapel', 'startIndex'));
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

        // if ($validator->fails()) {
        //     return redirect()->back()->withErrors($validator)->withInput();
        // }

        $tamu = new Tamu();
        $tamu->id_tamu = Str::uuid()->toString();
        $tamu->nama = $request->nama;
        $tamu->email = $request->email;
        $tamu->alamat = $request->alamat;
        $tamu->no_telpon = $request->no_telpon;
        $tamu->save();

        $pegawai = Pegawai::all()->first();
        // if (!$pegawai) {
        //     return redirect()->back()->withErrors(['message' => 'Pegawai tidak ditemukan'])->withInput();
        // }
        $pegawaiData = explode(',', $request->pegawai);
        

        $kedatanganTamu = new KedatanganTamu();
        $kedatanganTamu->id_kedatangan = Str::uuid()->toString();
        $kedatanganTamu->id_tamu = $tamu->id_tamu;
        $kedatanganTamu->NIP = $pegawaiData[0];
        $kedatanganTamu->id_user = $pegawaiData[1];
        $kedatanganTamu->instansi = $request->instansi;
        $kedatanganTamu->tujuan = $request->tujuan;
        $kedatanganTamu->waktu_perjanjian = $request->waktu_perjanjian;
        $kedatanganTamu->waktu_kedatangan = null;
        $kedatanganTamu->qr_code = null;
        $kedatanganTamu->save();

        $qrCodeContent = "$kedatanganTamu->id_kedatangan";
        $qrCodeHtml = DNS2D::getBarcodePNG($qrCodeContent, 'QRCODE');
        $kedatanganTamu->qr_code = $qrCodeHtml;
        $kedatanganTamu->save();

        return response()->json([
            'success' => true,
            'qr_code' => $qrCodeHtml,
        ]);
    }

    public function storeKurir2(Request $request)
    {
        $ekspedisi = new Ekspedisi();
        $ekspedisi->id_ekspedisi = Str::uuid()->toString();
        $ekspedisi->nama_kurir = $request->nama_kurir;
        $ekspedisi->ekspedisi = $request->ekspedisi;
        $ekspedisi->save();

        $pegawai = Pegawai::all()->first();
        $id_user = $pegawai->user->id;
        // Decode base64 image
        $imageData = base64_decode($request->foto);
        $fileName = uniqid() . '.jpeg';
        dd($fileName);
        $filePath = 'uploads' . $fileName;
        Storage::put($filePath, $imageData);

        // Save file path to the database
        $kedatanganEkspedisi = new KedatanganEkspedisi();
        $kedatanganEkspedisi->id_kedatanganEkspedisi = Str::uuid()->toString();
        $kedatanganEkspedisi->id_ekspedisi = $ekspedisi->id_ekspedisi;
        $kedatanganEkspedisi->NIP = $request->pegawai;
        $kedatanganEkspedisi->id_user = $id_user;
        $kedatanganEkspedisi->foto = $filePath;
        $kedatanganEkspedisi->waktu_kedatangan = now();
        $kedatanganEkspedisi->save();
        return redirect()->back()->with('success', 'Ekspedisi berhasil ditambahkan');
    }

    public function storeKurir(Request $request)
    {
        // Debugging request data
        // dd($request->all()); // Ini akan menunjukkan semua data yang diterima

        // Simpan data ekspedisi
        $ekspedisi = new Ekspedisi();
        $ekspedisi->id_ekspedisi = Str::uuid()->toString();
        $ekspedisi->nama_kurir = $request->nama_kurir;
        $ekspedisi->ekspedisi = $request->ekspedisi;
        $ekspedisi->no_telpon = $request->no_telpon;
        $ekspedisi->save();

        // Temukan pegawai berdasarkan ID
        $pegawai = Pegawai::all()->first();


        // Ambil data URL foto
        $fotoData = $request->input('foto');

        // Cek apakah data foto ada dan memiliki format yang benar
        if ($fotoData && strpos($fotoData, ',') !== false) {
            $fotoParts = explode(',', $fotoData);

            // Pastikan ada setidaknya dua elemen (header dan data)
            if (count($fotoParts) === 2) {
                $fotoData = $fotoParts[1];
                $fotoData = base64_decode($fotoData);

                // Tentukan nama file dan path penyimpanan
                $fileName = 'kurir_' . time() . '.png';
                $filePath = 'public/img-kurir/' . $fileName;

                // Simpan file gambar ke storage
                Storage::put($filePath, $fotoData);

                // Simpan data kedatangan ekspedisi
                $pegawaiData = explode(',', $request->pegawai);
                $kedatanganEkspedisi = new KedatanganEkspedisi();
                $kedatanganEkspedisi->id_kedatangan = Str::uuid()->toString();
                $kedatanganEkspedisi->id_ekspedisi = $ekspedisi->id_ekspedisi;
                $kedatanganEkspedisi->NIP = $pegawaiData[0];
                $kedatanganEkspedisi->id_user = $pegawaiData[1];
                $kedatanganEkspedisi->foto = $filePath;
                $kedatanganEkspedisi->waktu_kedatangan = now();
                $kedatanganEkspedisi->save();

                // Berhasil menyimpan
                return response()->json(['message' => 'Data berhasil disimpan.'], 200);
            } else {
                // Format data URL tidak valid
                return response()->json(['error' => 'Format data foto tidak valid.'], 400);
            }
        } else {
            // Data foto tidak ada
            return response()->json(['error' => 'Data foto tidak ditemukan.'], 400);
        }
    }



    public function about(){
        return view('user.about');
    }

}