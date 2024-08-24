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

class AdminController extends Controller
{
    public function index()
    {
        // Tentukan awal dan akhir bulan ini
        $startOfMonth = now()->startOfMonth()->format('Y-m-d');
        $endOfMonth = now()->endOfMonth()->format('Y-m-d');

        // Tentukan awal dan akhir minggu ini
        $startOfWeek = now()->startOfWeek()->format('Y-m-d');
        $endOfWeek = now()->endOfWeek()->format('Y-m-d');

        // Menghitung jumlah kunjungan tamu per hari dalam rentang bulan ini
        $tamuPerHari = KedatanganTamu::selectRaw('DATE(waktu_perjanjian) as tanggal, COUNT(*) as jumlah')
            ->whereBetween('waktu_perjanjian', [$startOfMonth, $endOfMonth])
            ->groupBy('tanggal')
            ->pluck('jumlah', 'tanggal');

        // Menghitung jumlah kunjungan kurir per hari dalam rentang bulan ini
        $kurirPerHari = KedatanganEkspedisi::selectRaw('DATE(waktu_kedatangan) as tanggal, COUNT(*) as jumlah')
            ->whereBetween('waktu_kedatangan', [$startOfMonth, $endOfMonth])
            ->groupBy('tanggal')
            ->pluck('jumlah', 'tanggal');

        // Menghitung jumlah kedatangan tamu per minggu dalam rentang bulan ini
        $tamuPerMinggu = KedatanganTamu::selectRaw('WEEK(waktu_perjanjian) as minggu, COUNT(*) as jumlah')
            ->whereBetween('waktu_perjanjian', [$startOfMonth, $endOfMonth])
            ->groupBy('minggu')
            ->pluck('jumlah', 'minggu');

        // Menghitung jumlah kedatangan kurir per minggu dalam rentang bulan ini
        $kurirPerMinggu = KedatanganEkspedisi::selectRaw('WEEK(waktu_kedatangan) as minggu, COUNT(*) as jumlah')
            ->whereBetween('waktu_kedatangan', [$startOfMonth, $endOfMonth])
            ->groupBy('minggu')
            ->pluck('jumlah', 'minggu');

        // Menghitung jumlah kedatangan tamu per hari dalam rentang minggu ini
        $tamuPerHariMinggu = KedatanganTamu::selectRaw('DATE(waktu_perjanjian) as tanggal, COUNT(*) as jumlah')
            ->whereBetween('waktu_perjanjian', [$startOfWeek, $endOfWeek])
            ->groupBy('tanggal')
            ->pluck('jumlah', 'tanggal');

        // Menghitung jumlah kedatangan kurir per hari dalam rentang minggu ini
        $kurirPerHariMinggu = KedatanganEkspedisi::selectRaw('DATE(waktu_kedatangan) as tanggal, COUNT(*) as jumlah')
            ->whereBetween('waktu_kedatangan', [$startOfWeek, $endOfWeek])
            ->groupBy('tanggal')
            ->pluck('jumlah', 'tanggal');

        // Membuat rentang tanggal dari awal bulan hingga akhir bulan
        $labels = collect();
        $currentDate = now()->startOfMonth();

        while ($currentDate <= now()->endOfMonth()) {
            $labels->push($currentDate->format('d')); // Format hanya tanggal (d)
            $currentDate->addDay();
        }

        // Konversi labels dari Collection menjadi array
        $labelsArray = $labels->toArray();

        // Mengisi dataset dengan data per hari
        $datasetTamu = [];
        $datasetKurir = [];

        foreach ($labelsArray as $label) {
            // Gunakan format 'Y-m-d' untuk mengambil data, tetapi tampilkan hanya 'd' di chart
            $fullDate = now()->startOfMonth()->format('Y-m') . '-' . $label;
            $datasetTamu[] = $tamuPerHari->get($fullDate, 0);
            $datasetKurir[] = $kurirPerHari->get($fullDate, 0);
        }

        // Menggabungkan kedatangan tamu dan kurir untuk ditampilkan
        $kedatanganTamu = KedatanganTamu::all()->map(function ($item) {
            $item->type = 'tamu';
            return $item;
        });

        $kedatanganKurir = KedatanganEkspedisi::all()->map(function ($item) {
            $item->type = 'kurir';
            return $item;
        });

        $kedatangan = $kedatanganTamu->merge($kedatanganKurir)->sortByDesc('waktu_kedatangan');

        $totalTamuPerBulan = $tamuPerHari->sum();  
        $totalKurirPerBulan = $kurirPerHari->sum();
        $totalPerBulan = $totalTamuPerBulan + $totalKurirPerBulan;

        // Menghitung total kedatangan tamu dan kurir per minggu
        $totalTamuPerMinggu = $tamuPerMinggu->sum();
        $totalKurirPerMinggu = $kurirPerMinggu->sum();

        // Menghitung total kedatangan tamu dan kurir per hari minggu ini
        $totalTamuPerHariMinggu = $tamuPerHariMinggu->sum();
        $totalKurirPerHariMinggu = $kurirPerHariMinggu->sum();

        $startOfLastMonth = now()->subMonth()->startOfMonth()->format('Y-m-d');
        $endOfLastMonth = now()->subMonth()->endOfMonth()->format('Y-m-d');
        // dd($startOfLastMonth, $endOfLastMonth);

        $totalTamuBulanLalu = KedatanganTamu::whereBetween('waktu_perjanjian', [$startOfLastMonth, $endOfLastMonth])
        ->count();

        $totalKurirBulanLalu = KedatanganEkspedisi::whereBetween('waktu_kedatangan', [$startOfLastMonth, $endOfLastMonth])
        ->count();

        $totalPerBulanLalu = $totalTamuBulanLalu + $totalKurirBulanLalu;

        // Hitung persentase kenaikan atau penurunan
        $persentaseKenaikan = $totalPerBulanLalu > 0
            ? (($totalPerBulan - $totalPerBulanLalu) / $totalPerBulanLalu) * 100
            : 0;
            // dd($persentaseKenaikan);
            

        // Membuat chart
        $chart = (new Chart)->setType('line')
            ->setWidth('100%')
            ->setHeight(300)
            ->setLabels($labelsArray)
            ->setDataset('Tamu', 'line', $datasetTamu)
            ->setDataset('Kurir', 'line', $datasetKurir);

        return view('admin.dashboard', compact(
            'chart',
            'kedatangan',
            'totalPerBulan',
            'totalTamuPerMinggu',
            'totalKurirPerMinggu',
            'totalTamuPerHariMinggu',
            'totalKurirPerHariMinggu',
            'persentaseKenaikan'
        ));
    }

    public function pagination()
    {
        // dd($mapel);
        $mapel = Pegawai::select('PTK')->distinct()->get();
        // return $mapel;   
        $listpegawai = Pegawai::paginate(10);
        $listpegawai->withPath('/admin/pegawai');
        return view('admin.pegawai', compact('listpegawai', 'mapel'));
    }

    public function pegawai()
    {
        return view('admin.pegawai', compact('listpegawai'));
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

        $kedatanganTamu = KedatanganTamu::all()->map(function ($item) {
            $item->type = 'tamu';
            $item->formatWaktu = Carbon::parse($item->waktu_perjanjian)->translatedFormat('l, d-m-Y');
            return $item;
        });

        $kedatanganKurir = KedatanganEkspedisi::all()->map(function ($item) {
            $item->type = 'kurir';
            $item->formatWaktu = Carbon::parse($item->waktu_kedatangan)->translatedFormat('l, d-m-Y');
            return $item;
        });

        $kedatangan = $kedatanganTamu->merge($kedatanganKurir)->sortByDesc('waktu_kedatangan');

        return view('admin.kunjungan', compact('chart', 'kedatangan'));
    }

    public function getDetail($id_kedatangan)
    {
        $item = KedatanganTamu::find($id_kedatangan) ?? KedatanganEkspedisi::find($id_kedatangan);

        return view('components.admin.card_detail', compact('item'))->render();
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