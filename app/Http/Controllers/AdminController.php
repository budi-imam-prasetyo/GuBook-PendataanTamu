<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use Akaunting\Apexcharts\Chart;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $chart = (new Chart)->setType('area')
            ->setWidth('100%')
            ->setHeight(300)
            ->setLabels([1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 29, 22, 23, 24, 25, 26, 27, 28, 29, 30])
            ->setDataset('Tamu', 'area', [5, 8, 4, 9, 7, 8, 4, 10, 3, 9, 3, 9, 9, 3, 10, 12, 12, 9, 3, 6, 9, 7, 3, 10, 9, 7, 4, 9, 6, 7])
            ->setDataset('Kurir', 'area', [9, 3, 6, 8, 3, 10, 4, 7, 5, 4, 9, 5, 9, 12, 6, 12, 5, 7, 4, 9, 5, 5, 7, 6, 7, 9, 8, 4, 9, 8]);

        return view('admin.dashboard', compact('chart'));
    }
    public function pegawai()
    {
        $listpegawai = Pegawai::all();
        return view('admin.pegawai', compact('listpegawai'));
    }
    public function kunjungan()
    {
        $chart = (new Chart)->setType('donut')
            ->setWidth('100%')
            ->setHeight(180)
            ->setLabels(['Diterima', 'Ditolak', 'Menunggu'])
            ->setDataset('Teams', 'donut', [44, 55, 41])
            ->setOptions([
                'legend' => [
                    'position' => 'bottom'
                ]
            ]);

        return view('admin.kunjungan', compact('chart'));
    }
    public function store(Request $request)
    {
        $qrCodeData = $request->input('qr_code_data');
        // Proses data QR code di sini
        return response()->json(['message' => 'QR Code processed successfully']);
    }
}