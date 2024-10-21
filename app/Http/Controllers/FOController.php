<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use App\Models\KedatanganEkspedisi;
use App\Models\KedatanganTamu;
use App\Models\Pegawai;
use App\Models\User;
use Akaunting\Apexcharts\Chart;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PegawaiExport;
use App\Imports\PegawaiImport;
use App\Models\Tamu;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class FOController extends Controller
{
    public function index(Request $request)
    {
        // Auth::logout();
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
        $tamuHariIni = KedatanganTamu::whereDate('waktu_perjanjian', Carbon::today())->count();
        $kurirHariIni = KedatanganEkspedisi::whereDate('waktu_kedatangan', Carbon::today())->count();

        //! Tamu dan Kurir Kemarin
        $tamuKemarin = KedatanganTamu::whereDate('waktu_perjanjian', Carbon::yesterday())->count();
        $kurirKemarin = KedatanganEkspedisi::whereDate('waktu_kedatangan', Carbon::yesterday())->count();

        //! Persentase Kenaikan Harian
        $persentaseTamuHarian = $this->hitungPersentaseKenaikan($tamuHariIni, $tamuKemarin);
        $persentaseKurirHarian = $this->hitungPersentaseKenaikan($kurirHariIni, $kurirKemarin);

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

        //! Tamu dan Kurir Minggu Lalu
        $startOfLastWeek = Carbon::now()->subWeek()->startOfWeek();
        $endOfLastWeek = Carbon::now()->subWeek()->endOfWeek();
        $tamuMingguLalu = KedatanganTamu::whereBetween('waktu_perjanjian', [$startOfLastWeek, $endOfLastWeek])->count();
        $kurirMingguLalu = KedatanganEkspedisi::whereBetween('waktu_kedatangan', [$startOfLastWeek, $endOfLastWeek])->count();
        $totalMingguLalu = $tamuMingguLalu + $kurirMingguLalu;

        //! Persentase Kenaikan Mingguan
        $persentaseKenaikanMingguan = $this->hitungPersentaseKenaikan($totalMingguIni, $totalMingguLalu);

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

        $chart = (new Chart)->setType('bar')
            ->setWidth('100%')
            ->setHeight(300)
            ->setLabels($labels)
            ->setDataset('Tamu', 'bar', $datasetTamu)
            ->setDataset('Kurir', 'bar', $datasetKurir)
            ->setOptions([
                'yaxis' => [
                    'stacked' => true,
                    'stepSize' => $max
                ],
                'plotOptions' => [
                    'line' => [
                        'stacked' => true
                    ]
                ],
                'scales' => [
                    'yAxes' => [[
                        'stacked' => true
                    ]],
                    'xAxes' => [[
                        'stacked' => true
                    ]]
                ]
            ]);
        $data = KedatanganTamu::where('id_kedatangan', $request->qr_code)->first();


        return view('FO.dashboard', compact(
            'chart',
            'kedatangan',
            'tamuHariIni',
            'kurirHariIni',
            'totalMingguIni',
            'totalBulanIni',
            'persentaseKenaikan',
            'persentaseTamuHarian',
            'persentaseKurirHarian',
            'persentaseKenaikanMingguan',
            'data'
        ));
    }

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


    public function getTamuDetail($id_kedatangan)
    {
        // Cari data kedatangan tamu berdasarkan ID kedatangan
        $kedatangan = KedatanganTamu::find($id_kedatangan);

        if ($kedatangan) {
            // Ambil data tamu yang terkait dengan kedatangan
            $tamu = $kedatangan->tamu;

            if ($tamu) {
                if ($kedatangan->status !== 'diterima') {
                    return response()->json([
                        'success' => false,
                        'message' => 'Status tamu belum "Diterima".'
                    ], 403);
                }

                $waktuPerjanjian = Carbon::parse($kedatangan->waktu_perjanjian);
                $now = Carbon::now();
                $batasWaktu = $waktuPerjanjian->copy()->addHour();

                if ($now->between($waktuPerjanjian, $batasWaktu)) {
                    return response()->json([
                        'success' => true,
                        'name' => $tamu->nama,
                        'email' => $tamu->email,
                        'phone' => $tamu->no_telpon,
                        'waktu_perjanjian' => $kedatangan->waktu_perjanjian,
                        'status' => $kedatangan->status
                    ]);
                } else if ($now->lessThan($waktuPerjanjian)) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Waktu scan belum mencapai jadwal perjanjian.'
                    ], 403);
                } else {
                    return response()->json([
                        'success' => false,
                        'message' => 'Waktu scan telah melewati batas 1 jam dari jadwal perjanjian.'
                    ], 403);
                }
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Tamu tidak ditemukan.'
                ], 404);
            }
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Kedatangan tamu tidak ditemukan.'
            ], 404);
        }
    }
    public function updateKedatangan(Request $request)
    {
        try {
            $kedatanganTamu = KedatanganTamu::where('id_kedatangan', $request->id_kedatangan)->first();
            if (!$kedatanganTamu) {
                return response()->json(['success' => false, 'message' => 'Data kedatangan tamu tidak ditemukan']);
            }

            // Set waktu kedatangan
            $kedatanganTamu->waktu_kedatangan = now();

            // Handle foto
            if ($request->hasFile('foto')) {
                $foto = $request->file('foto');
                $namaFoto = time() . '_' . $request->id_tamu . '.' . $foto->getClientOriginalExtension();
                $foto->storeAs('public/img-tamu', $namaFoto);
                $kedatanganTamu->foto = $namaFoto;
            }

            $kedatanganTamu->save();

            return response()->json(['success' => true, 'message' => 'Data berhasil diperbarui']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }


    public function pegawai(Request $request)
    {
        // Mengambil data kedatangan tamu berdasarkan QR code
        $data = KedatanganTamu::where('id_kedatangan')->first();

        // Mengambil data mapel yang unik
        $mapel = Pegawai::select('PTK')->distinct()->get();

        // Mengambil nilai pencarian dari request
        $search = $request->input('search');

        // Jika ada input pencarian, filter data pegawai berdasarkan nama
        $listpegawai = Pegawai::whereHas('user', function ($query) use ($search) {
            $query->where('nama', 'like', "%{$search}%");
        })->paginate(10)->withPath('/FO/pegawai');

        // $listpegawai->withPath('/FO/pegawai');

        return view('FO.pegawai', compact('listpegawai', 'mapel', 'data'));
    }


    public function pegawaiPost(Request $request)
    {
        $data = KedatanganTamu::where('id_kedatangan', $request->qr_code)->first();

        return redirect()->back()->with('data', $data); // Mengalihkan kembali dengan data
    }
    public function fetchData(Request $request)
    {
        $data = KedatanganTamu::where('id_kedatangan', $request->qr_code)->first();

        return view('FO.dashboard', compact('data'));
    }

    public function laporanTamu(Request $request)
    {
        $requests = $request;
        $sort = $request->get('sort', 'nama_tamu');
        $direction = $request->get('direction', 'asc');

        $query = KedatanganTamu::with(['tamu', 'user'])
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


        return view('FO.laporanTamu', compact('data', 'sort', 'direction', 'requests', 'currentFilter', 'nullFoto'));
    }
    public function laporanKurir(Request $request)
    {
        $requests = $request;
        $sort = $request->get('sort', 'nama_kurir');
        $direction = $request->get('direction', 'asc');

        $query = KedatanganEkspedisi::with(['ekspedisi', 'user'])
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
                        $query->whereBetween('kedatangan_ekspedisi.waktu_perjanjian', [
                            Carbon::parse($request->startDate)->startOfDay(),
                            Carbon::parse($request->endDate)->endOfDay()
                        ]);
                    }
                    break;

                case 'monthly':
                    if ($request->filled(['month', 'monthYear'])) {
                        $startDate = Carbon::createFromDate($request->monthYear, $request->month, 1)->startOfMonth();
                        $endDate = $startDate->copy()->endOfMonth();
                        $query->whereBetween('kedatangan_ekspedisi.waktu_perjanjian', [$startDate, $endDate]);
                    }
                    break;

                case 'yearly':
                    if ($request->filled('year')) {
                        $startDate = Carbon::createFromDate($request->year, 1, 1)->startOfYear();
                        $endDate = $startDate->copy()->endOfYear();
                        $query->whereBetween('kedatangan_ekspedisi.waktu_perjanjian', [$startDate, $endDate]);
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


        return view('FO.laporanKurir', compact('data', 'sort', 'direction', 'requests', 'currentFilter', 'nullFoto'));
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
            ->setHeight('100%')
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

        $konfirmasi = KedatanganTamu::where('status', 'Menunggu')
        ->paginate(10)
        ->through(function ($item) {
            $item->waktu_perjanjian = Carbon::parse($item->waktu_perjanjian)->translatedFormat('l, d-m-Y H:i');
            $item->waktu_kedatangan = $item->waktu_kedatangan ? Carbon::parse($item->waktu_kedatangan)->translatedFormat('l, d-m-Y H:i') : null;
            $item->sudah_datang = $item->waktu_kedatangan && Carbon::parse($item->waktu_kedatangan)->diffInHours($item->waktu_perjanjian) <= 1;
            return $item;
        });
        $kunjungan_tamu = KedatanganTamu::where('status', 'Diterima')
        ->paginate(10)
        ->through(function ($item) {
            // Similar transformations as $konfirmasi
            return $item;
        });

        return view('FO.kunjungan', compact('chart', 'konfirmasi', 'kunjungan_tamu'));
    }
    
    public function getDetail($id_kedatangan)
    {
        $item = KedatanganTamu::find($id_kedatangan) ?? KedatanganEkspedisi::find($id_kedatangan);
        if ($item) {
            $item->formatWaktu = Carbon::parse($item->waktu_perjanjian ?? $item->waktu_kedatangan)->translatedFormat('H:i l, d-m-Y');
            $item->type = ['tamu', 'kurir'];
            $item->fotoUrl = $item->foto ? Storage::url('public/img-tamu/' . $item->foto) :  Storage::url($item->foto);
        }
        $nullFoto = asset('assets/user.jpg');
        // dd($item);

        return view('components.FO.card_detail', compact('item', 'nullFoto'))->render();
    }
}
