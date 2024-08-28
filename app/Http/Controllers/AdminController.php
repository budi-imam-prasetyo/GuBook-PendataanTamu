<?php

namespace App\Http\Controllers;

use App\Models\KedatanganEkspedisi;
use App\Models\KedatanganTamu;
use App\Models\Pegawai;
use App\Models\User;
use Akaunting\Apexcharts\Chart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PegawaiExport;
use App\Imports\PegawaiImport;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function index()
    {
        //! Tamu dan Kurir Bulan Ini
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();

        $tamuBulanIni = KedatanganTamu::whereBetween('waktu_perjanjian', [$startOfMonth, $endOfMonth])
            ->count();
        $kurirBulanIni = KedatanganEkspedisi::whereBetween('waktu_kedatangan', [$startOfMonth, $endOfMonth])
            ->count();
        $totalBulanIni = $tamuBulanIni + $kurirBulanIni;

        //! Tamu dan Kurir Bulan Lalu
        $startOfLastMonth = Carbon::now()->subMonth()->startOfMonth();
        $endOfLastMonth = Carbon::now()->subMonth()->endOfMonth();

        $tamuBulanLalu = KedatanganTamu::whereBetween('waktu_perjanjian', [$startOfLastMonth, $endOfLastMonth])
        ->count();
        $kurirBulanLalu = KedatanganEkspedisi::whereBetween('waktu_kedatangan', [$startOfLastMonth, $endOfLastMonth])
        ->count();
        $totalBulanLalu = $tamuBulanLalu + $kurirBulanLalu;

        //! Persentase
        if ($totalBulanLalu > 0) {
            $persentaseKenaikan = (($totalBulanIni - $totalBulanLalu) / $totalBulanLalu) * 100;
        } elseif ($totalBulanIni > 0) {
            $persentaseKenaikan = (($totalBulanIni - $totalBulanLalu) / $totalBulanIni) * 100;
        } else {
            $persentaseKenaikan = 1;
        }

        //! Tamu dan Kurir Hari Ini
        $tamuHariIni = KedatanganTamu::whereDate('waktu_perjanjian', Carbon::today())
            ->count();
        $kurirHariIni = KedatanganEkspedisi::whereDate('waktu_kedatangan', Carbon::today())
            ->count();

        //! Dataset Grafik
        $tamuPerHari = KedatanganTamu::selectRaw('DATE(waktu_perjanjian) as tanggal, COUNT(*) as jumlah')
        ->whereBetween('waktu_perjanjian', [$startOfMonth, $endOfMonth])
        ->groupBy('tanggal')
        ->pluck('jumlah', 'tanggal');

        $kurirPerHari = KedatanganEkspedisi::selectRaw('DATE(waktu_kedatangan) as tanggal, COUNT(*) as jumlah')
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

        //! Tamu dan Kurir Minggu Ini
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();
        $tamuMingguIni = KedatanganTamu::whereBetween('waktu_perjanjian', [
            $startOfWeek,
            $endOfWeek
        ])->count();
        $kurirMingguIni = KedatanganEkspedisi::whereBetween('waktu_kedatangan', [
            $startOfWeek,
            $endOfWeek
        ])->count();
        $totalMingguIni = $tamuMingguIni + $kurirMingguIni;

        //! View List Kunjungan Tamu dan Kurir
        $kedatanganTamu = KedatanganTamu::all()->map(function ($item) {
            $item->type = 'tamu';
            return $item;
        });
        $kedatanganKurir = KedatanganEkspedisi::all()->map(function ($item) {
            $item->type = 'kurir';
            return $item;
        });
        $kedatangan = $kedatanganTamu->merge($kedatanganKurir)->sortByDesc('waktu_kedatangan');

        
        // dd($persentaseKenaikan, $totalBulanIni, $totalBulanLalu);

        //! Chart
        $chart = (new Chart)->setType('area')
            ->setWidth('100%')
            ->setHeight(300)
            ->setLabels($labels)
            ->setDataset('Tamu', 'area', $datasetTamu)
            ->setDataset('Kurir', 'area', $datasetKurir)
            ->setOptions(
                [
                    'yaxis' => [
                        'stepSize' => 1
                    ]
                ]
            );

        return view('admin.dashboard', compact(
            'chart',
            'kedatangan',
            'tamuHariIni',
            'kurirHariIni',
            'totalMingguIni',
            'totalBulanIni',
            'persentaseKenaikan'
        ));
    }

    public function pegawai()
    {
        // dd($mapel);
        $mapel = Pegawai::select('PTK')->distinct()->get();
        // return $mapel;   
        $listpegawai = Pegawai::paginate(10);
        $listpegawai->withPath('/admin/pegawai');
        return view('admin.pegawai', compact('listpegawai', 'mapel'));
    }


    public function storePegawai(Request $request)
    {
        $user = User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'pegawai',
        ]);

        // Cek apakah user berhasil dibuat
        if ($user) {
            // Buat pegawai baru
            $pegawai = Pegawai::create([
                'id_user' => $user->id,
                'NIP' => $request->NIP,
                'no_telpon' => $request->no_telpon,
                'PTK' => $request->PTK,
            ]);

            return redirect()->route('admin.pegawai')->with('add', '+1');
        }

        return redirect()->route('admin.pegawai')->with('error', 'Gagal menambahkan pegawai');
    }

    public function editPegawai($NIP)
    {
        $pegawai = Pegawai::find($NIP);

        if ($pegawai) {
            return view('admin.edit-pegawai', compact('pegawai'));
        }

        return redirect()->route('admin.pegawai')->with('error', 'Pegawai tidak ditemukan');
    }

    public function updateGuru(Request $request, $id)
    {
        // Debug data request
        // dd($request->all());

        $pegawai = Pegawai::where('NIP', $request->NIP)->first();

        if ($pegawai) {
            // Perbarui data pegawai
            $pegawai->no_telpon = $request->newNo_telpon;
            $pegawai->NIP = $request->newNIP;
            $pegawai->PTK = $request->newPTK;
            $pegawai->save();

            if ($pegawai->user) {
                $pegawai->user->nama = $request->newName;
                $pegawai->user->email = $request->newEmail;
                $pegawai->user->password = Hash::make($request->newPassword);
                $pegawai->user->save();
            }
            return redirect()->route('admin.pegawai')->with('update', '↻1');
        }
        return redirect()->route('admin.pegawai')->with('error', 'Gagal mengupdate pegawai');
    }


    public function deletePegawai($NIP)
    {
        $pegawai = Pegawai::where('NIP', $NIP)->delete();
        // return $pegawai;

        // if ($pegawai) {
        // $pegawai->delete();
        return redirect()->route('admin.pegawai')->with('delete', '-1');
        // }

        // return redirect()->route('admin.pegawai')->with('error', 'Pegawai tidak ditemukan');
    }

    public function export()
    {
        return Excel::download(new PegawaiExport, 'pegawai.xlsx');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xls,xlsx'
        ]);


        try {
            Excel::import(new PegawaiImport, $request->file('file'));
            // dd($request->all());
            return redirect()->back()->with('success', 'Data pegawai berhasil diimport');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal mengimport data: ' . $e->getMessage());
        }
    }




    public function kunjungan()
    {
        $statusDiterima = KedatanganTamu::where('status', 'Diterima')->count();
        $statusDitolak = KedatanganTamu::where('status', 'Ditolak')->count();
        $statusMenunggu = KedatanganTamu::where('status', 'Menunggu')->count();

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
            'yaxis' => [
                'stepSize' => 1
            ],
            ]);

        $kedatanganTamu = KedatanganTamu::all()->map(function ($item) {
            $item->type = 'tamu';
            $item->formatWaktu = Carbon::parse($item->waktu_perjanjian)->translatedFormat('l, d-m-Y H:i');
            return $item;
        });

        $kedatanganKurir = KedatanganEkspedisi::all()->map(function ($item) {
            $item->type = 'kurir';
            $item->formatWaktu = Carbon::parse($item->waktu_kedatangan)->translatedFormat('l, d-m-Y H:i');
            return $item;
        });

        $kedatangan = $kedatanganTamu->merge($kedatanganKurir)->sortByDesc('waktu_kedatangan');

        return view('admin.kunjungan', compact('chart', 'kedatangan'));
    }

    public function getDetail($id_kedatangan)
    {
        $item = KedatanganTamu::find($id_kedatangan) ?? KedatanganEkspedisi::find($id_kedatangan);
        if ($item) {
            $item->formatWaktu = Carbon::parse($item->waktu_perjanjian ?? $item->waktu_kedatangan)->translatedFormat('H:i l, d-m-Y');
            $item->type = ['tamu', 'kurir'];
            $item->fotoUrl = Storage::url($item->foto);
        }
        $nullFoto = asset('assets/user.jpg');

        return view('components.admin.card_detail', compact('item', 'nullFoto'))->render();
    }
    public function store(Request $request)
    {
        $qrCodeData = $request->input('qr_code_data');
        // Proses data QR code di sini
        return response()->json(['message' => 'QR Code processed successfully']);
    }
    public function show($id)
    {
        $kedatangan = KedatanganTamu::findOrFail($id);
        // dd($id);
        return response()->json($kedatangan);
    }
}
