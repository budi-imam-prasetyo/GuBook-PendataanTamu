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
    public function store(Request $request)
    {
        $qrCodeData = $request->input('qr_code_data');
        // Proses data QR code di sini
        return response()->json(['message' => 'QR Code processed successfully']);
    }
}