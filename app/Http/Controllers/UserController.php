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
use Illuminate\Support\Facades\Response;
use DNS2D;
use GuzzleHttp\Client;
use App\Mail\TamuNotification;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

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

    public function checkAppointments(Request $request)
    {
        $waktuPerjanjian = new Carbon($request->waktu_perjanjian);
        $pegawaiData = explode(',', $request->pegawai);
        $NIP = $pegawaiData[0];

        // Check for appointments within 15 minutes before and after the requested time
        $conflictingAppointments = KedatanganTamu::where('NIP', $NIP)
            ->whereBetween('waktu_perjanjian', [
                $waktuPerjanjian->copy()->subMinutes(15),
                $waktuPerjanjian->copy()->addMinutes(15)
            ])
            ->count();

        return response()->json(['conflict' => $conflictingAppointments > 0]);
    }

    public function storeTamu(Request $request)
    {
        // dd($request->all());
        // Validasi awal data form
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'alamat' => 'required|string|max:255',
            'no_telpon' => 'required|string|max:15',
            'pegawai' => 'required|string',
            'instansi' => 'nullable|string|max:255',
            'tujuan' => 'required|string|max:255',
            'waktu_perjanjian' => 'required|date_format:Y-m-d\TH:i',
        ], [
            'nama.required' => 'Nama harus diisi.',
            'nama.string' => 'Nama harus berupa teks.',
            'nama.max' => 'Nama tidak boleh lebih dari 255 karakter.',

            'email.required' => 'Email harus diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.max' => 'Email tidak boleh lebih dari 255 karakter.',

            'alamat.required' => 'Alamat harus diisi.',
            'alamat.string' => 'Alamat harus berupa teks.',
            'alamat.max' => 'Alamat tidak boleh lebih dari 255 karakter.',

            'no_telpon.required' => 'Nomor telepon harus diisi.',
            'no_telpon.string' => 'Nomor telepon harus berupa teks.',
            'no_telpon.max' => 'Nomor telepon tidak boleh lebih dari 15 karakter.',

            'pegawai.required' => 'Pegawai harus dipilih.',
            'pegawai.string' => 'Pegawai harus berupa teks.',

            'tujuan.required' => 'Tujuan harus diisi.',
            'tujuan.string' => 'Tujuan harus berupa teks.',
            'tujuan.max' => 'Tujuan tidak boleh lebih dari 255 karakter.',

            'waktu_perjanjian.required' => 'Tanggal Pertemuan harus diisi.',
            'waktu_perjanjian.date_format' => 'Format tanggal pertemuan tidak valid (format yang diharapkan: Y-m-dTH:i).',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $waktuPerjanjian = new Carbon($request->waktu_perjanjian);
        $pegawaiData = explode(',', $request->pegawai);
        $NIP = $pegawaiData[0];


        $conflictingAppointments = KedatanganTamu::where('NIP', $NIP)
            ->whereBetween('waktu_perjanjian', [
                $waktuPerjanjian->copy()->subMinutes(15),
                $waktuPerjanjian->copy()->addMinutes(15)
            ])
            ->count();

        if ($conflictingAppointments > 0) {
            response()->json([
                'message' => 'Jadwal ini sudah terisi. Silakan pilih waktu lain.'
            ], 409);
        }

        // Verifikasi email menggunakan Hunter API
        $client = new Client();
        $response = $client->get('https://api.hunter.io/v2/email-verifier', [
            'query' => [
                'email' => $request->email,
                'api_key' => env('HUNTER_API_KEY'),
            ]
        ]);

        $data = json_decode($response->getBody()->getContents());
        if (!isset($data->data) || $data->data->result !== 'deliverable') {
            return redirect()->back()->withErrors(['email' => 'Email tidak valid atau tidak terdaftar di layanan email.'])->withInput();
        }

        // Cek apakah email valid
        if ($data->data->result !== 'deliverable') {
            return redirect()->back()->withErrors(['email' => 'Email tidak valid atau tidak terdaftar di layanan email.'])->withInput();
        }

        // Simpan data tamu jika email valid
        $tamu = new Tamu();
        $tamu->id_tamu = Str::uuid()->toString();
        $tamu->nama = $request->nama;
        $tamu->email = $request->email;
        $tamu->alamat = $request->alamat;
        $tamu->no_telpon = $request->no_telpon;
        $tamu->save();

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

        // Generate QR code in PNG format
        $qrCodeContent = "$kedatanganTamu->id_kedatangan";
        $qrCodePng = DNS2D::getBarcodePNG($qrCodeContent, 'QRCODE');
        $kedatanganTamu->qr_code = $qrCodePng;
        $kedatanganTamu->save();

        // Kirim email kepada pegawai
        $pegawaiData = explode(',', $request->pegawai);
        $pegawai = User::find($pegawaiData[1]);
        $pegawaiEmail = $pegawai->email;
        // dd($pegawaiEmail);
        // Ambil data pegawai berdasarkan id_user
        Mail::to($pegawaiEmail)->send(new TamuNotification($tamu));
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }


        return redirect()->back()->with('success', 'Pertemuan berhasil ditambahkan!');
    }


    public function storeKurir(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'nama_kurir' => 'required|string|max:255',
            'ekspedisi' => 'required|string|max:255',
            'no_telpon' => 'required|string|max:20',
            'pegawai' => 'required|string',
            'foto' => 'required|string'
        ], [
            'nama_kurir.required' => 'Nama kurir harus diisi.',
            'ekspedisi.required' => 'Nama ekspedisi harus diisi.',
            'no_telpon.required' => 'Nomor telepon harus diisi.',
            'pegawai.required' => 'Pegawai harus dipilih.',
            'foto.required' => 'Foto harus diambil.'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

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
                return redirect()->back()->with('success', 'Data berhasil disimpan.');
            } else {
                // Format data URL tidak valid
                return redirect()->back()->with('error', 'Format data foto tidak valid.');
            }
        } else {
            // Data foto tidak ada
            return redirect()->back()->with('error', 'Data foto tidak ditemukan.');
        }
    }



    public function about()
    {
        return view('user.about');
    }
}
