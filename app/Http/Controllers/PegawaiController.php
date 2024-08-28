<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use Illuminate\Http\Request;
use Akaunting\Apexcharts\Chart;
use App\Models\KedatanganEkspedisi;
use App\Models\KedatanganTamu;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class PegawaiController extends Controller
{
    public function index()
    {
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();
        $id_user = Auth::id();

        //! Tamu dan Kurir Hari Ini
        $tamuHariIni = KedatanganTamu::where('id_user', $id_user)->whereDate('waktu_perjanjian', Carbon::today())
            ->count();
        $kurirHariIni = KedatanganEkspedisi::where('id_user', $id_user)->whereDate('waktu_kedatangan', Carbon::today())
            ->count();

        //! Tamu dan Kurir Minggu Ini
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();
        $tamuMingguIni = KedatanganTamu::where('id_user', $id_user)->whereBetween('waktu_perjanjian', [
            $startOfWeek,
            $endOfWeek
        ])->count();
        $kurirMingguIni = KedatanganEkspedisi::where('id_user', $id_user)->whereBetween('waktu_kedatangan', [
            $startOfWeek,
            $endOfWeek
        ])->count();
        $totalMingguIni = $tamuMingguIni + $kurirMingguIni;

        //! Tamu dan Kurir Bulan Ini
        $tamuBulanIni = KedatanganTamu::where('id_user', $id_user)->whereBetween('waktu_perjanjian', [$startOfMonth, $endOfMonth])
            ->count();
        $kurirBulanIni = KedatanganEkspedisi::where('id_user', $id_user)->whereBetween('waktu_kedatangan', [$startOfMonth, $endOfMonth])
            ->count();
        $totalBulanIni = $tamuBulanIni + $kurirBulanIni;

        //! Tamu dan Kurir Bulan Lalu
        $startOfLastMonth = Carbon::now()->subMonth()->startOfMonth();
        $endOfLastMonth = Carbon::now()->subMonth()->endOfMonth();

        $tamuBulanLalu = KedatanganTamu::where('id_user', $id_user)->whereBetween('waktu_perjanjian', [$startOfLastMonth, $endOfLastMonth])
            ->count();
        $kurirBulanLalu = KedatanganEkspedisi::where('id_user', $id_user)->whereBetween('waktu_kedatangan', [$startOfLastMonth, $endOfLastMonth])
            ->count();
        $totalBulanLalu = $tamuBulanLalu + $kurirBulanLalu;
        // dd($totalBulanLalu, $totalBulanIni, $tamuBulanIni, $kurirBulanIni);

        //! Statistik Kedatangan
        if ($totalBulanLalu - $totalBulanIni == 0) {
            $statistik = 0;
        } else {
            $statistik = $totalBulanIni - $totalBulanLalu;
        }

        //! Dataset Grafik
        $tamuPerHari = KedatanganTamu::selectRaw('DATE(waktu_perjanjian) as tanggal, COUNT(*) as jumlah')
            ->where('id_user', $id_user)
            ->whereBetween('waktu_perjanjian', [$startOfMonth, $endOfMonth])
            ->groupBy('tanggal')
            ->pluck('jumlah', 'tanggal');

        $kurirPerHari = KedatanganEkspedisi::selectRaw('DATE(waktu_kedatangan) as tanggal, COUNT(*) as jumlah')
            ->where('id_user', $id_user)
            ->whereBetween('waktu_kedatangan', [$startOfMonth, $endOfMonth])
            ->groupBy('tanggal')
            ->pluck('jumlah', 'tanggal');

        $datasetTamu = [];
        $datasetKurir = [];
        $labels = [];

        for ($tanggal = $startOfMonth->copy(); $tanggal <= $endOfMonth; $tanggal->addDay()) {
            $formatTanggal = $tanggal->format('Y-m-d');
            $labels[] = $tanggal->format('d');
            $datasetTamu[] = $tamuPerHari->get($formatTanggal, 0);
            $datasetKurir[] = $kurirPerHari->get($formatTanggal, 0);
        }

        //! View List Kunjungan Tamu dan Kurir
        $kedatanganTamu = KedatanganTamu::all()->where('id_user', $id_user)->map(function ($item) {
            $item->type = 'tamu';
            return $item;
        });
        $kedatanganKurir = KedatanganEkspedisi::all()->where('id_user', $id_user)->map(function ($item) {
            $item->type = 'kurir';
            return $item;
        });
        $kedatangan = $kedatanganTamu->merge($kedatanganKurir)->sortByDesc('waktu_kedatangan');

        //! Chart
        $chart = (new Chart)->setType('bar')
            ->setWidth('100%')
            ->setHeight(300)
            ->setLabels($labels)
            ->setDataset('Tamu', 'bar', $datasetTamu)
            ->setDataset('Kurir', 'bar', $datasetKurir)
            ->setOptions(
                [
                    'yaxis' => [
                        'stepSize' => 1
                    ],
                    'colors' => ['#EF5F4C', '#CD5A36'],
                    'markers' => [
                        'colors' => [
                            '#EF5F4C',
                            '#CD5A36',
                        ],
                    ],
                    'stroke' => [
                        'colors' => [
                            '#EF5F4C',
                            '#CD5A36',
                        ]
                    ],

                ]
            );


        return view('pegawai.dashboard', compact('chart', 'totalBulanIni', 'tamuHariIni', 'kurirHariIni', 'totalMingguIni', 'kedatangan', 'statistik'));
    }

    public function kunjungan()
    {
        $id_user = Auth::id();

        $statusDiterima = KedatanganTamu::where('id_user', $id_user)->where('status', 'Diterima')->count();
        $statusDitolak = KedatanganTamu::where('id_user', $id_user)->where('status', 'Ditolak')->count();
        $statusMenunggu = KedatanganTamu::where('id_user', $id_user)->where('status', 'Menunggu')->count();

        // Membuat chart dengan data yang sudah dihitung
        $chart = (new Chart)->setType('donut')
            ->setWidth('100%')
            ->setHeight(180)
            ->setLabels(['Diterima', 'Ditolak', 'Menunggu'])
            ->setDataset('Teams', 'donut', [$statusDiterima, $statusDitolak, $statusMenunggu])
            ->setOptions([
                'legend' => [
                    'position' => 'bottom'
                ],
            'colors' => ['#EF5F4C', '#CD5A36'],
            'markers' => [
                'colors' => [
                    '#EF5F4C',
                    '#CD5A36',
                ],
            ],
            'stroke' => [
                'colors' => [
                    '#EF5F4C',
                    '#CD5A36',
                ]
            ],  
                'yaxis' => [
                    'stepSize' => 1
                ],
            ]);

        $kedatanganTamu = KedatanganTamu::all()->where('id_user', $id_user)->map(function ($item) {
            $item->type = 'tamu';
            $item->formatWaktu = Carbon::parse($item->waktu_perjanjian)->translatedFormat('l, d-m-Y H:i');
            return $item;
        });

        $kedatanganKurir = KedatanganEkspedisi::all()->where('id_user', $id_user)->map(function ($item) {
            $item->type = 'kurir';
            $item->formatWaktu = Carbon::parse($item->waktu_kedatangan)->translatedFormat('l, d-m-Y H:i');
            return $item;
        });

        $kedatangan = $kedatanganTamu->merge($kedatanganKurir)->sortByDesc('waktu_kedatangan');

        return view('pegawai.kunjungan', compact('chart', 'kedatangan'));
    }

    public function getDetail($id_kedatangan)
    {
        $item = KedatanganTamu::find($id_kedatangan) ?? KedatanganEkspedisi::find($id_kedatangan);
        if ($item) {
            $item->formatWaktu = Carbon::parse($item->waktu_perjanjian ?? $item->waktu_kedatangan)->translatedFormat('H:i l, d-m-Y');
            $item->type = ['tamu', 'kurir'];
        }

        return view('components.pegawai.card_detail', compact('item'))->render();
    }
    public function updateStatus(Request $request)
    {
        // dd($request);
        $kunjungan = KedatanganTamu::findOrFail($request->id_kedatangan);
        $kunjungan->status = $request->status;
        $kunjungan->save();
        return redirect()->back()->with('success', 'Status berhasil diupdate!');
    }
}
