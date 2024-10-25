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
    private function hitungPersentaseKenaikan($nilaiSekarang, $nilaiSebelumnya)
    {
        if ($nilaiSebelumnya > 0) {
            return round((($nilaiSekarang - $nilaiSebelumnya) / $nilaiSebelumnya) * 100, 2);
        } elseif ($nilaiSekarang > 0) {
            return 100; // 100% increase if previous value was 0
        } else {
            return 0; // No change if both values are 0
        }
    }

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

        //! Tamu dan Kurir Minggu Lalu
        $startOfLastWeek = Carbon::now()->subWeek()->startOfWeek();
        $endOfLastWeek = Carbon::now()->subWeek()->endOfWeek();
        $tamuMingguLalu = KedatanganTamu::whereBetween('waktu_perjanjian', [$startOfLastWeek, $endOfLastWeek])->count();
        $kurirMingguLalu = KedatanganEkspedisi::whereBetween('waktu_kedatangan', [$startOfLastWeek, $endOfLastWeek])->count();
        $totalMingguLalu = $tamuMingguLalu + $kurirMingguLalu;

        //! Persentase Kenaikan Mingguan
        $persentaseKenaikanMingguan = $this->hitungPersentaseKenaikan($totalMingguIni, $totalMingguLalu);

        //! Tamu dan Kurir Hari Ini
        $tamuHariIni = KedatanganTamu::whereDate('waktu_perjanjian', Carbon::today())->count();
        $kurirHariIni = KedatanganEkspedisi::whereDate('waktu_kedatangan', Carbon::today())->count();

        //! Tamu dan Kurir Kemarin
        $tamuKemarin = KedatanganTamu::whereDate('waktu_perjanjian', Carbon::yesterday())->count();
        $kurirKemarin = KedatanganEkspedisi::whereDate('waktu_kedatangan', Carbon::yesterday())->count();

        //! Persentase Kenaikan Harian
        $persentaseTamuHarian = $this->hitungPersentaseKenaikan($tamuHariIni, $tamuKemarin);
        $persentaseKurirHarian = $this->hitungPersentaseKenaikan($kurirHariIni, $kurirKemarin);

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
        $max = 2; // Pastikan $max sudah didefinisikan
        $max = ($max < 10) ? $max : (($max < 20) ? 5 : 10);

        $chart = (new Chart)->setType('area')
            ->setWidth('100%')
            ->setHeight(300)
            ->setLabels($labels)
            ->setDataset('Tamu', 'area', $datasetTamu)
            ->setDataset('Kurir', 'area', $datasetKurir)
            ->setOptions(
                [
                    'yaxis' => [
                        'stepSize' => $max
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
            'persentaseKenaikan',
            'persentaseTamuHarian',
            'persentaseKurirHarian',
            'persentaseKenaikanMingguan'
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

    public function laporanTamu(Request $request)
    {
        $requests = $request;
        $sort = $request->get('sort', 'nama_tamu');
        $direction = $request->get('direction', 'asc');

        $query = KedatanganTamu::with(['tamu', 'user'])
            ->orderBy('waktu_perjanjian', 'desc')
            ->select('kedatangan_tamu.*')
            ->join('tamu', 'kedatangan_tamu.id_tamu', '=', 'tamu.id_tamu')
            ->join('users', 'kedatangan_tamu.id_user', '=', 'users.id')
            ->select('kedatangan_tamu.*', 'tamu.nama as nama_tamu', 'users.nama as nama_pegawai');

        // Gunakan when untuk menangani sorting
        $data = $query->when($sort === 'tamu.nama', function ($q) use ($direction) {
            return $q->orderBy('nama_tamu', $direction);
        }, function ($q) use ($sort, $direction) {
            return $q->orderBy($sort, $direction);
        })->paginate(10);

        // Iterate through the result set and add fotoUrl for each result

        // Apply date filters based on filter type
        if ($request->filled('filterType')) {
            switch ($request->filterType) {
                case 'daily':
                    if ($request->filled(['startDate', 'endDate'])) {
                        $query->whereBetween('kedatangan_tamu.waktu_perjanjian', [
                            Carbon::parse($request->startDate)->startOfDay(),
                            Carbon::parse($request->endDate)->endOfDay()
                        ]);
                    }
                    break;

                case 'monthly':
                    if ($request->filled(['month', 'monthYear'])) {
                        $startDate = Carbon::createFromDate($request->monthYear, $request->month, 1)->startOfMonth();
                        $endDate = $startDate->copy()->endOfMonth();
                        $query->whereBetween('kedatangan_tamu.waktu_perjanjian', [$startDate, $endDate]);
                    }
                    break;

                case 'yearly':
                    if ($request->filled('year')) {
                        $startDate = Carbon::createFromDate($request->year, 1, 1)->startOfYear();
                        $endDate = $startDate->copy()->endOfYear();
                        $query->whereBetween('kedatangan_tamu.waktu_perjanjian', [$startDate, $endDate]);
                    }
                    break;
            }
        }

        // Execute the query with sorting and pagination
        $data = $query->orderBy($sort, $direction)->paginate(10);

        // Transform data after query
        $data->through(function ($item) {
            if ($item->status === 'ditolak') {
                $item->status_display = 'Ditolak';
            } elseif ($item->status === 'menunggu') {
                $item->status_display = 'Belum Dikonfirmasi';
            } elseif (is_null($item->waktu_kedatangan) && Carbon::parse($item->waktu_perjanjian)->addHour()->isPast()) {
                $item->status_display = 'Tidak Datang';
            } elseif (
                !is_null($item->waktu_kedatangan) &&
                Carbon::parse($item->waktu_kedatangan)->lte(Carbon::parse($item->waktu_perjanjian)->addHour())
            ) {
                $item->status_display = 'Selesai';
            } elseif (is_null($item->waktu_kedatangan)) {
                $item->status_display = 'Belum Datang';
            } else {
                $item->status_display = $item->status;
            }
            return $item;
        });

        // Pass current filter values to the view
        $currentFilter = [
            'type' => $request->filterType,
            'startDate' => $request->startDate,
            'endDate' => $request->endDate,
            'month' => $request->month,
            'monthYear' => $request->monthYear,
            'year' => $request->year,
        ];

        $nullFoto = asset('assets/user.jpg');


        return view('admin.laporanTamu', compact('data', 'sort', 'direction', 'requests', 'currentFilter', 'nullFoto'));
    }

    public function laporanKurir(Request $request)
    {
        $requests = $request;
        $sort = $request->get('sort', 'nama_kurir');
        $direction = $request->get('direction', 'asc');

        $query = KedatanganEkspedisi::with(['ekspedisi', 'user'])
            ->orderBy('waktu_kedatangan', 'desc')
            ->select('kedatangan_ekspedisi.*')
            ->join('ekspedisi', 'kedatangan_ekspedisi.id_ekspedisi', '=', 'ekspedisi.id_ekspedisi')
            ->join('users', 'kedatangan_ekspedisi.id_user', '=', 'users.id')
            ->select('kedatangan_ekspedisi.*', 'ekspedisi.nama_kurir as nama_kurir', 'users.nama as nama_pegawai');

        // Gunakan when untuk menangani sorting
        $data = $query->when($sort === 'tamu.nama', function ($q) use ($direction) {
            return $q->orderBy('nama_kurir', $direction);
        }, function ($q) use ($sort, $direction) {
            return $q->orderBy($sort, $direction);
        })->paginate(10);

        // Iterate through the result set and add fotoUrl for each result

        // Apply date filters based on filter type
        if ($request->filled('filterType')) {
            switch ($request->filterType) {
                case 'daily':
                    if ($request->filled(['startDate', 'endDate'])) {
                        $query->whereBetween('kedatangan_ekspedisi.waktu_kedatangan', [
                            Carbon::parse($request->startDate)->startOfDay(),
                            Carbon::parse($request->endDate)->endOfDay()
                        ]);
                    }
                    break;

                case 'monthly':
                    if ($request->filled(['month', 'monthYear'])) {
                        $startDate = Carbon::createFromDate($request->monthYear, $request->month, 1)->startOfMonth();
                        $endDate = $startDate->copy()->endOfMonth();
                        $query->whereBetween('kedatangan_ekspedisi.waktu_kedatangan', [$startDate, $endDate]);
                    }
                    break;

                case 'yearly':
                    if ($request->filled('year')) {
                        $startDate = Carbon::createFromDate($request->year, 1, 1)->startOfYear();
                        $endDate = $startDate->copy()->endOfYear();
                        $query->whereBetween('kedatangan_ekspedisi.waktu_kedatangan', [$startDate, $endDate]);
                    }
                    break;
            }
        }

        // Execute the query with sorting and pagination
        $data = $query->orderBy($sort, $direction)->paginate(10);

        // Pass current filter values to the view
        $currentFilter = [
            'type' => $request->filterType,
            'startDate' => $request->startDate,
            'endDate' => $request->endDate,
            'month' => $request->month,
            'monthYear' => $request->monthYear,
            'year' => $request->year,
        ];

        $nullFoto = asset('assets/user.jpg');


        return view('admin.laporanKurir', compact('data', 'sort', 'direction', 'requests', 'currentFilter', 'nullFoto'));
    }

    public function searchKurir(Request $request)
    {
        $search = $request->get('query');

        $data = KedatanganEkspedisi::join('ekspedisi', 'kedatangan_ekspedisi.id_ekspedisi', '=', 'ekspedisi.id_ekspedisi')
        ->join('users', 'kedatangan_ekspedisi.id_user', '=', 'users.id')
        ->where(function ($query) use ($search) {
            $query->where('ekspedisi.nama_kurir', 'LIKE', "%{$search}%")
            ->orWhere('ekspedisi.ekspedisi', 'LIKE', "%{$search}%")
            ->orWhere('users.nama', 'LIKE', "%{$search}%")
            ->orWhere('ekspedisi.no_telpon', 'LIKE', "%{$search}%");
        })
            ->select([
                'kedatangan_ekspedisi.id_kedatangan',
                'ekspedisi.nama_kurir',
                'users.nama as nama_pegawai',
                'ekspedisi.ekspedisi',
                'ekspedisi.no_telpon',
                'kedatangan_ekspedisi.waktu_kedatangan',
                'kedatangan_ekspedisi.foto'
            ])
            ->orderBy('kedatangan_ekspedisi.waktu_kedatangan', 'desc')
            ->get();

        return response()->json($data);
    }
    public function searchTamu(Request $request)
    {
        $search = $request->get('query');

        $data = KedatanganTamu::join('tamu', 'kedatangan_tamu.id_tamu', '=', 'tamu.id_tamu')
        ->join('users', 'kedatangan_tamu.id_user', '=', 'users.id')
        ->where(function ($query) use ($search) {
            $query->where('tamu.nama', 'LIKE', "%{$search}%")
            ->orWhere('tamu.email', 'LIKE', "%{$search}%")
            ->orWhere('users.nama', 'LIKE', "%{$search}%");
        })
            ->select([
                'kedatangan_tamu.*',
                'tamu.nama',
                'tamu.email',
                'tamu.no_telpon',
                'users.nama as pegawai'
            ])
            ->orderBy('kedatangan_tamu.waktu_perjanjian', 'desc')
            ->get();

        // Transform data untuk status
        $data->transform(function ($item) {
            if ($item->status === 'ditolak') {
                $item->status_display = 'Ditolak';
            } elseif ($item->status === 'menunggu') {
                $item->status_display = 'Belum Dikonfirmasi';
            } elseif (is_null($item->waktu_kedatangan) && Carbon::parse($item->waktu_perjanjian)->addHour()->isPast()) {
                $item->status_display = 'Tidak Datang';
            } elseif (
                !is_null($item->waktu_kedatangan) &&
                Carbon::parse($item->waktu_kedatangan)->lte(Carbon::parse($item->waktu_perjanjian)->addHour())
            ) {
                $item->status_display = 'Selesai';
            } elseif (is_null($item->waktu_kedatangan)) {
                $item->status_display = 'Belum Datang';
            } else {
                $item->status_display = $item->status;
            }

            return $item;
        });

        return response()->json($data);
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

        $kedatanganTamu = KedatanganTamu::orderBy('waktu_perjanjian', 'desc')
        ->paginate(10);  // Menggunakan paginate, bukan get()

        $kedatanganTamu->getCollection()->transform(function ($item) {
            $item->formatWaktu = Carbon::parse($item->waktu_perjanjian)->translatedFormat('l, d-m-Y H:i');
            return $item;
        });


        return view('admin.kunjungan', compact('chart', 'kedatanganTamu'));
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
